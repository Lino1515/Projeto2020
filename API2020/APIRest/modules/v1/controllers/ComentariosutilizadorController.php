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
use app\models\Comentariosutilizador;
use app\models\ComentariosutilizadorSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentariosutilizadorController implements the CRUD actions for Comentariosutilizador model.
 */
class ComentariosutilizadorController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\comentariosutilizador';

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
        $Id_comentario = $changedAttributes["Id_comentario"];
        $Id_utilizador = $changedAttributes["Id_utilizador"];
        $Like_Dislike = $changedAttributes["Like_Dislike"];

        $myObj = new \stdClass();

        $myObj->tabela = "Comentarios Utilizadores";
        $myObj->Id_comentario = $Id_comentario;
        $myObj->Id_utilizador = $Id_utilizador;
        $myObj->Like_Dislike = $Like_Dislike;

        $myJSON = json_encode($myObj);

        if ($insert) {
            $this->FazPublish("INSERT", $myJSON);
        } else {
            $this->FazPublish("UPDATE", $myJSON);
        }
    }

    public function afterDelete($changedAttributes) {
        parent::afterDelete($changedAttributes);

        $Id_comentario = $changedAttributes["Id_comentario"];
        $Id_utilizador = $changedAttributes["Id_utilizador"];
        $Like_Dislike = $changedAttributes["Like_Dislike"];

        $myObj = new \stdClass();

        $myObj->tabela = "Comentarios Utilizador";
        $myObj->Id_comentario = $Id_comentario;
        $myObj->Id_utilizador = $Id_utilizador;
        $myObj->Like_Dislike = $Like_Dislike;
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
    // * Lists all Comentariosutilizador models.
    // * @return mixed
    // */
    // public function actionIndex()
    // {
    // $searchModel = new ComentariosutilizadorSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // return $this->render('index', [
    // 'searchModel' => $searchModel,
    // 'dataProvider' => $dataProvider,
    // ]);
    // }
    // /**
    // * Displays a single Comentariosutilizador model.
    // * @param integer $Id_comentario
    // * @param integer $Id_utilizador
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionView($Id_comentario, $Id_utilizador)
    // {
    // return $this->render('view', [
    // 'model' => $this->findModel($Id_comentario, $Id_utilizador),
    // ]);
    // }
    // /**
    // * Creates a new Comentariosutilizador model.
    // * If creation is successful, the browser will be redirected to the 'view' page.
    // * @return mixed
    // */
    // public function actionCreate()
    // {
    // $model = new Comentariosutilizador();
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]);
    // }
    // return $this->render('create', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Updates an existing Comentariosutilizador model.
    // * If update is successful, the browser will be redirected to the 'view' page.
    // * @param integer $Id_comentario
    // * @param integer $Id_utilizador
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionUpdate($Id_comentario, $Id_utilizador)
    // {
    // $model = $this->findModel($Id_comentario, $Id_utilizador);
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]);
    // }
    // return $this->render('update', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Deletes an existing Comentariosutilizador model.
    // * If deletion is successful, the browser will be redirected to the 'index' page.
    // * @param integer $Id_comentario
    // * @param integer $Id_utilizador
    // * @return mixed
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // public function actionDelete($Id_comentario, $Id_utilizador)
    // {
    // $this->findModel($Id_comentario, $Id_utilizador)->delete();
    // return $this->redirect(['index']);
    // }
    // /**
    // * Finds the Comentariosutilizador model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $Id_comentario
    // * @param integer $Id_utilizador
    // * @return Comentariosutilizador the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // protected function findModel($Id_comentario, $Id_utilizador)
    // {
    // if (($model = Comentariosutilizador::findOne(['Id_comentario' => $Id_comentario, 'Id_utilizador' => $Id_utilizador])) !== null) {
    // return $model;
    // }
    // throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
