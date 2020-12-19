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
use app\models\Comentarios;
use app\models\ComentariosSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Comentarios';

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
        
       /* var_dump($changedAttributes);
        exit;*/
        //Obter dados do registo em causa
        $nome = $changedAttributes["Data"];
        $tipo = $changedAttributes["Descricao"];
        $id_user = $changedAttributes["Id_utilizador"];
        $id_jogo = $changedAttributes["Id_jogo"];

        $myObj = new \stdClass();

        $myObj->tabela = "Comentarios";
        $myObj->nome = $nome;
        $myObj->tipo = $tipo;
        $myObj->Id_Utilizador = $id_user;
        $myObj->Id_Jogo = $id_jogo;
        

        $myJSON = json_encode($myObj);

        if ($insert) {
            $this->FazPublish("INSERT", $myJSON);
        } else {
            $this->FazPublish("UPDATE", $myJSON);
        }
    }

    public function afterDelete($changedAttributes) {
         
        parent::afterDelete($changedAttributes);
        $prod_descricao = $changedAttributes["Descricao"];
        $prod_data = $changedAttributes["Data"];
        $prod_IdUser = $changedAttributes["Id_utilizador"];
        $prod_IdJogo = $changedAttributes["Id_jogo"];
        $myObj = new \stdClass();

        $myObj->tabela = "Comentarios";
        $myObj->descricao = $prod_descricao;
        $myObj->data = $prod_data;
        $myObj->Id_Utilizador = $prod_IdUser;
        $myObj->Id_Jogo = $prod_IdJogo;
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
    // * Lists all Comentarios models.
    // * @return mixed
    // */
    // public function actionIndex()
    // {
    // $searchModel = new ComentariosSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // return $this->render('index', [
    // 'searchModel' => $searchModel,
    // 'dataProvider' => $dataProvider,
    // ]);
    // }
    // /**
    // * Displays a single Comentarios model.
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
    // * Creates a new Comentarios model.
    // * If creation is successful, the browser will be redirected to the 'view' page.
    // * @return mixed
    // */
    // public function actionCreate()
    // {
    // $model = new Comentarios();
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'id' => $model->Id]);
    // }
    // return $this->render('create', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Updates an existing Comentarios model.
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
    // * Deletes an existing Comentarios model.
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
    // * Finds the Comentarios model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $id
    // * @return Comentarios the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // protected function findModel($id)
    // {
    // if (($model = Comentarios::findOne($id)) !== null) {
    // return $model;
    // }
    // throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
