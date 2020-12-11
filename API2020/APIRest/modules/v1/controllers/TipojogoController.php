<?php

namespace app\modules\v1\controllers;

use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\base\ActionFilter;
use Yii;
use app\models\Tipojogo;
use app\models\TipojogoSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use yii\web\ForbiddenHttpException;

/**
 * TipojogoController implements the CRUD actions for Tipojogo model.
 */
class TipojogoController extends ActiveController {

    public $modelClass = 'app\models\tipojogo';

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

    public function actionTipo($id) {
        echo "elo";exit;
        $tipoJogo = Tipojogo::find()->where("Id=" . $id)->one();
        if ($tipoJogo) {
            return ['Id pesquisado ' => $id, 'Tipo jogo encontrado' => $tipoJogo->Nome];
        }
        return ['Id pesquisado ' => $id, 'Tipo jogo encontrado' => "erro!"];
    }

    public function checkAccess($action, $model = null, $params = []){
       /* if (Yii::$app->user->can('admin')) {*/
           /* if ($action === 'post' or $action === 'delete'){
                if (\Yii::$app->user->isGuest OR \Yii::$app->user->can('moderador'))
                {
                    throw new ForbiddenHttpException('Apenas poderá'.$action.' utilizadores registados…');
                }
            }
       /* } else {
            throw new ForbiddenHttpException;
        }*/
    }
    public function actionTotal(){
        $totalmodel = new $this->modelClass;
        $recs = $totalmodel::find()->all();
        return['total' => 'Tem um total de ' . count($recs) . ' generos inseridos na base de dados'];
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
