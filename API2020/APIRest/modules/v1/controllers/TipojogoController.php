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
use app\modules\v1\models\Tipojogo;
use app\modules\v1\models\TipojogoSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipojogoController implements the CRUD actions for Tipojogo model.
 */
class TipojogoController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\tipojogo';

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
        $permisao = \app\models\AuthAssignment::findOne(['item_name' => 'admin']);

        if ($action === 'create' or $action === 'delete' or $action === 'update') {
            if (Yii::$app->user->isGuest || ($user->id == (int) $permisao->user_id) == false) {

                throw new ForbiddenHttpException('Apenas poderá' . $action . ' utilizadores registados…');
            }
        }
    }

    public function actionTipo($id) {
        $tipoJogo = Tipojogo::find()->where("Id=" . $id)->one();
        if ($tipoJogo) {
            return ['Id pesquisado ' => $id, 'Tipo jogo encontrado' => $tipoJogo->Nome];
        }
        return ['Id pesquisado ' => $id, 'Tipo jogo encontrado' => "erro!"];
    }

    public function actionTotal() {
        $totalmodel = new $this->modelClass;
        $recs = $totalmodel::find()->all();
        return['total' => 'Tem um total de ' . count($recs) . ' generos inseridos na base de dados'];
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        //Obter dados do registo em causa
        $nome = $changedAttributes["Nome"];
        $Descricao = $changedAttributes["Descricao"];

        $myObj = new \stdClass();

        $myObj->tabela = "Tipo de jogo";
        $myObj->nome = $nome;
        $myObj->Descricao = $Descricao;

        $myJSON = json_encode($myObj);

        if ($insert) {
            $this->FazPublish("INSERT", $myJSON);
        } else {
            $this->FazPublish("UPDATE", $myJSON);
        }
    }

    public function afterDelete($changedAttributes) {
        parent::afterDelete($changedAttributes);
        $nome = $changedAttributes["Nome"];
        $Descricao = $changedAttributes["Descricao"];

        $myObj = new \stdClass();

        $myObj->tabela = "Tipo de jogo";
        $myObj->nome = $nome;
        $myObj->Descricao = $Descricao;

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
    // * Lists all Tipojogo models.
    // * @return mixed
    // */
    // public function actionIndex()
    // {
    // $searchModel = new TipojogoSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // return $this->render('index', [
    // 'searchModel' => $searchModel,
    // 'dataProvider' => $dataProvider,
    // ]);
    // }
    // /**
    // * Displays a single Tipojogo model.
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
    // * Creates a new Tipojogo model.
    // * If creation is successful, the browser will be redirected to the 'view' page.
    // * @return mixed
    // */
    // public function actionCreate()
    // {
    // $model = new Tipojogo();
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'id' => $model->Id]);
    // }
    // return $this->render('create', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Updates an existing Tipojogo model.
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
    // * Deletes an existing Tipojogo model.
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
    // * Finds the Tipojogo model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $id
    // * @return Tipojogo the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // protected function findModel($id)
    // {
    // if (($model = Tipojogo::findOne($id)) !== null) {
    // return $model;
    // }
    // throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
