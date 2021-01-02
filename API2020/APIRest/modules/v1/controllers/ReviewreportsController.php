<?php

namespace app\modules\v1\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\base\ActionFilter;
use yii\app;
use yii\web\ForbiddenHttpException;
use Yii;
use app\models\Reviewreports;
use app\models\ReviewreportsSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewreportsController implements the CRUD actions for Reviewreports model.
 */
class ReviewreportsController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\reviewreports';

    public function behaviors() {
        $behaviors = parent::behaviors();
        // remove authentication filter if there is one
        unset($behaviors['authenticator']);
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => [$this, 'auth']
                ],
                'class' => QueryParamAuth::className()
            ],
        ];
        return $behaviors;
    }

    public function auth($username, $password) {
        $user = \app\models\User::findByUsername($username);
        if ($user && $user->validatePassword($password)) {
            //$token = $user->getAuthKey();
            /* echo "" . $user->password_hash . "<br>" . $user->username . "<br>" . $user->auth_key . '<br>' . $user->verification_token;
              exit; */
            return $user;
        }
        return null;
    }

    public function checkAccess($action, $model = null, $params = []) {
        $user = \app\models\User::findByUsername(Yii::$app->user->identity->username);
        $permisaoadmin = \app\models\AuthAssignment::findOne(['item_name' => 'admin']);
        $permisaomod = \app\models\AuthAssignment::findOne(['item_name' => 'moderador']);

        if ($action === 'create' or $action === 'delete' or $action === 'update') {
            if (Yii::$app->user->isGuest || ($user->id == (int) $permisaoadmin->user_id) == false || ($user->id == (int) $permisaomod->user_id) == false) {

                throw new ForbiddenHttpException('Apenas poderá dar' . $action . ' utilizadores registados…');
            }
        }
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        //Obter dados do registo em causa
        $Id_review = $changedAttributes["Id_review"];
        $Id_utilizador = $changedAttributes["Id_utilizador"];
        $Data = $changedAttributes["Data"];
        $Descricao = $changedAttributes["Descricao"];

        $myObj = new \stdClass();

        $myObj->tabela = "Review Reports";
        $myObj->Data = $Data;
        $myObj->Descricao = $Descricao;
        $myObj->Id_review = $Id_review;
        $myObj->Id_utilizador = $Id_utilizador;

        $myJSON = json_encode($myObj);

        if ($insert) {
            $this->FazPublish("INSERT", $myJSON);
        } else {
            $this->FazPublish("UPDATE", $myJSON);
        }
    }

    public function afterDelete($changedAttributes) {
        parent::afterDelete($changedAttributes);
        $Id_review = $changedAttributes["Id_review"];
        $Id_utilizador = $changedAttributes["Id_utilizador"];
        $Data = $changedAttributes["Data"];
        $Descricao = $changedAttributes["Descricao"];

        $myObj = new \stdClass();

        $myObj->tabela = "Review Reports";
        $myObj->Data = $Data;
        $myObj->Descricao = $Descricao;
        $myObj->Id_review = $Id_review;
        $myObj->Id_utilizador = $Id_utilizador;
        $myJSON = json_encode($myObj);
        $this->FazPublish("DELETE", $myJSON);
    }

    public function FazPublish($canal, $msg) {
        $server = "127.0.0.1";
        $port = 1883;
        $username = "" . Yii::$app->user->identity->username; // set your username
        $password = "" . Yii::$app->user->identity->password_hash; // set your password
        $client_id = "phpMQTT-publisher"; // unique!
        $mqtt = new \app\mosquitto\phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        } else {
            file_put_contents("debug.output", "Time out!");
        }
    }

    public function actionTotal() {
        $totalmodel = new $this->modelClass;
        $recs = $totalmodel::find()->all();
        return['total' => 'Tem um total de ' . count($recs) . ' registos inseridos na base de dados'];
    }
    // /**
    // * {@inheritdoc}
    // */
    // public function behaviors()
    // {
    // return [
    // 'verbs' => [
    // 'class' => VerbFilter::className(),
    // 'actions' => [
    // 'delete' => ['POST'],
    // ],
    // ],
    // ];
    // }
    // /**
    // * Lists all Reviewreports models.
    // * @return mixed
    // */
    // public function actionIndex()
    // {
    // $searchModel = new ReviewreportsSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // return $this->render('index', [
    // 'searchModel' => $searchModel,
    // 'dataProvider' => $dataProvider,
    // ]);
    // }
    // /**
    // * Displays a single Reviewreports model.
    // * @param integer $Id_review
    // * @param integer $Id_utilizador
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionView($Id_review, $Id_utilizador)
    // {
    // return $this->render('view', [
    // 'model' => $this->findModel($Id_review, $Id_utilizador),
    // ]);
    // }
    // /**
    // * Creates a new Reviewreports model.
    // * If creation is successful, the browser will be redirected to the 'view' page.
    // * @return mixed
    // */
    // public function actionCreate()
    // {
    // $model = new Reviewreports();
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]);
    // }
    // return $this->render('create', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Updates an existing Reviewreports model.
    // * If update is successful, the browser will be redirected to the 'view' page.
    // * @param integer $Id_review
    // * @param integer $Id_utilizador
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionUpdate($Id_review, $Id_utilizador)
    // {
    // $model = $this->findModel($Id_review, $Id_utilizador);
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]);
    // }
    // return $this->render('update', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Deletes an existing Reviewreports model.
    // * If deletion is successful, the browser will be redirected to the 'index' page.
    // * @param integer $Id_review
    // * @param integer $Id_utilizador
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionDelete($Id_review, $Id_utilizador)
    // {
    // $this->findModel($Id_review, $Id_utilizador)->delete();
    // return $this->redirect(['index']);
    // }
    // /**
    // * Finds the Reviewreports model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $Id_review
    // * @param integer $Id_utilizador
    // * @return Reviewreports the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // protected function findModel($Id_review, $Id_utilizador)
    // {
    // if (($model = Reviewreports::findOne(['Id_review' => $Id_review, 'Id_utilizador' => $Id_utilizador])) !== null) {
    // return $model;
    // }
    // throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
