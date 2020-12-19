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
use app\models\Jogos;
use app\models\JogosSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JogosController implements the CRUD actions for Jogos model.
 */
class JogosController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\jogos';

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
            if (!(($user == (int) $permisaoadmin->user_id))) {

                throw new ForbiddenHttpException('Apenas poderá dar ' . $action . ' utilizadores registados…');
            }
        }
    }

    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);

        //Obter dados do registo em causa
        $nome = $changedAttributes["Nome"];
        $Descricao = $changedAttributes["Descricao"];
        $Data = $changedAttributes["Data"];
        $Trailer = $changedAttributes["Trailer"];
        $Imagem = $changedAttributes["Imagem"];
        $Id_tipojogo = $changedAttributes["Id_tipojogo"];

        $myObj = new \stdClass();

        $myObj->tabela = "Jogos";
        $myObj->nome = $nome;
        $myObj->Descricao = $Descricao;
        $myObj->Data = $Data;
        $myObj->Trailer = $Trailer;
        $myObj->Imagem = $Imagem;
        $myObj->Id_tipojogo = $Id_tipojogo;

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
        $Data = $changedAttributes["Data"];
        $Trailer = $changedAttributes["Trailer"];
        $Imagem = $changedAttributes["Imagem"];
        $Id_tipojogo = $changedAttributes["Id_tipojogo"];

        $myObj = new \stdClass();

        $myObj->tabela = "Jogos";
        $myObj->Nome = $nome;
        $myObj->Descricao = $Descricao;
        $myObj->Data = $Data;
        $myObj->Trailer = $Trailer;
        $myObj->Imagem = $Imagem;
        $myObj->Id_tipojogo = $Id_tipojogo;
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

    //Obtem o top 5 mais recente introduzido
    public function actionTop() {
        $limit = 5;
        $model = new $this->modelClass;
        $results = $model::find()->limit($limit)->orderBy(['Data' => SORT_DESC, 'Nome' => SORT_ASC])->all();
        return['limite' => $limit, 'results' => $results];
    }

    //Obtem os ultimos 5 mais antigos introduzido
    public function actionBot() {
        $limit = 5;
        $model = new $this->modelClass;
        $results = $model::find()->limit($limit)->orderBy(['Data' => SORT_ASC, 'Nome' => SORT_ASC])->all();
        return['limite' => $limit, 'results' => $results];
    }

    //Ordena data asc
    public function actionDataasc() {
        $model = new $this->modelClass;
        $results = $model::find()->orderBy(['Data' => SORT_ASC, 'Nome' => SORT_ASC])->all();
        return['results' => $results];
    }

    //Ordena data desc
    public function actionDatadesc() {
        $model = new $this->modelClass;
        $results = $model::find()->orderBy(['Data' => SORT_DESC, 'Nome' => SORT_DESC])->all();
        return['results' => $results];
    }

    //Ordena nomes asc
    public function actionNomeasc() {
        $model = new $this->modelClass;
        $results = $model::find()->orderBy(['Nome' => SORT_ASC, 'Data' => SORT_ASC])->all();
        return['results' => $results];
    }

    //Ordena nomes desc
    public function actionNomedesc() {
        $model = new $this->modelClass;
        $results = $model::find()->orderBy(['Nome' => SORT_DESC, 'Data' => SORT_DESC])->all();
        return['results' => $results];
    }

    //Ordena a melhor review do jogo com id $id
    public function actionTopreview($id) {
        $model = new $this->modelClass;
        $modelReview = new \app\modules\v1\models\Review;
        $review = $modelReview::find()->limit(1)->where(['Id_jogo' => $id])->orderBy(['Score' => SORT_DESC])->all();
        $jogo = $model::find()->where(['Id' => $id])->all();
        /* var_dump($jogo == null);
          exit; */
        if ($jogo != null and $review != null)
            return['Jogo' => $jogo, 'Melhor review' => $review];
        if ($review == null)
            return['Jogo' => $jogo, 'Este jogo ainda nao tem reviews'];
        return['Nao foi possivel encontrar este jogo.'];
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
    // * Lists all Jogos models.
    // * @return mixed
    // */
    // public function actionIndex()
    // {
    // $searchModel = new JogosSearch();
    // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    // return $this->render('index', [
    // 'searchModel' => $searchModel,
    // 'dataProvider' => $dataProvider,
    // ]);
    // }
    // /**
    // * Displays a single Jogos model.
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
    // * Creates a new Jogos model.
    // * If creation is successful, the browser will be redirected to the 'view' page.
    // * @return mixed
    // */
    // public function actionCreate()
    // {
    // $model = new Jogos();
    // if ($model->load(Yii::$app->request->post()) && $model->save()) {
    // return $this->redirect(['view', 'id' => $model->Id]);
    // }
    // return $this->render('create', [
    // 'model' => $model,
    // ]);
    // }
    // /**
    // * Updates an existing Jogos model.
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
    // * Deletes an existing Jogos model.
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
    // * Finds the Jogos model based on its primary key value.
    // * If the model is not found, a 404 HTTP exception will be thrown.
    // * @param integer $id
    // * @return Jogos the loaded model
    // * @throws NotFoundHttpException if the model cannot be found
    // */
    // protected function findModel($id)
    // {
    // if (($model = Jogos::findOne($id)) !== null) {
    // return $model;
    // }
    // throw new NotFoundHttpException('The requested page does not exist.');
    // }
}
