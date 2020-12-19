<?php

namespace app\modules\v1\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\base\ActionFilter;
use yii\app;
use app\models\User;
use yii\web\ForbiddenHttpException;
use Yii;
use app\models\Review;
use app\models\ReviewSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\review';

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
            return $user;
        }
        return null;
    }

    public function checkAccess($action, $model = null, $params = []) {

        $user = Yii::$app->user->identity->id;
        $permisaoadmin = \app\models\AuthAssignment::findOne(['item_name' => 'admin']);
        $permisaomod = \app\models\AuthAssignment::findOne(['item_name' => 'moderador']);

        // MODERADORES E ADMINS
        // var_dump(Yii::$app->user->identity);        exit;
        if ($action === 'create' or $action === 'delete' or $action === 'update') {
            // Falso 
            if (!(($user == (int) $permisaoadmin->user_id) || ($user == (int) $permisaomod->user_id))) {

                throw new ForbiddenHttpException('Apenas poderá dar ' . $action . ' utilizadores registados…');
            }
        }
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        //Obter dados do registo em causa
        $Data = $changedAttributes["Data"];
        $Descricao = $changedAttributes["Descricao"];
        $Id_Jogo = $changedAttributes["Id_Jogo"];
        $Score = $changedAttributes["Score"];
        $Id_Utilizador = $changedAttributes["Id_Utilizador"];

        $myObj = new \stdClass();

        $myObj->tabela = "Review";
        $myObj->Data = $Data;
        $myObj->Descricao = $Descricao;
        $myObj->Id_Jogo = $Id_Jogo;
        $myObj->Score = $Score;
        $myObj->Id_Utilizador = $Id_Utilizador;

        $myJSON = json_encode($myObj);

        if ($insert) {
            $this->FazPublish("INSERT", $myJSON);
        } else {
            $this->FazPublish("UPDATE", $myJSON);
        }
    }

    public function afterDelete($changedAttributes) {
        parent::afterDelete($changedAttributes);
        $Data = $changedAttributes["Data"];
        $Descricao = $changedAttributes["Descricao"];
        $Id_Jogo = $changedAttributes["Id_Jogo"];
        $Score = $changedAttributes["Score"];
        $Id_Utilizador = $changedAttributes["Id_Utilizador"];

        $myObj = new \stdClass();

        $myObj->tabela = "Review";
        $myObj->Data = $Data;
        $myObj->Descricao = $Descricao;
        $myObj->Id_Jogo = $Id_Jogo;
        $myObj->Score = $Score;
        $myObj->Id_Utilizador = $Id_Utilizador;
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
        return['total' => count($recs)];
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
    // * Lists all Review models.
    // * @return mixed
    // */
    // public function actionIndex()
    // {
    // $searchModel = new ReviewSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // return $this->render('index', [
    // 'searchModel' => $searchModel,
    // 'dataProvider' => $dataProvider,
    // ]);
    // }
    // /**
    // * Displays a single Review model.
    // * @param integer $id
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionView($id)
    // {
    // return $this->render('view', [
    // 'model' => $this->findModel($id),
    // ]);
    // }
    // /**
    // * Creates a new Review model.
    // * If creation is successful, the browser will be redirected to the 'view' page.
    // * @return mixed
    // */
    // public function actionCreate()
    // {
    // $model = new Review();
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'id' => $model->Id]);
    // }
    // return $this->render('create', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Updates an existing Review model.
    // * If update is successful, the browser will be redirected to the 'view' page.
    // * @param integer $id
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionUpdate($id)
    // {
    // $model = $this->findModel($id);
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'id' => $model->Id]);
    // }
    // return $this->render('update', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Deletes an existing Review model.
    // * If deletion is successful, the browser will be redirected to the 'index' page.
    // * @param integer $id
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionDelete($id)
    // {
    // $this->findModel($id)->delete();
    // return $this->redirect(['index']);
    // }
    // /**
    // * Finds the Review model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $id
    // * @return Review the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // protected function findModel($id)
    // {
    // if (($model = Review::findOne($id)) !== null) {
    // return $model;
    // }
    // throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
