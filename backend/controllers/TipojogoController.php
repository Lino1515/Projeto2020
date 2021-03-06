<?php

namespace backend\controllers;

use Yii;
use app\models\Tipojogo;
use app\models\TipojogoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * TipojogoController implements the CRUD actions for Tipojogo model.
 */
class TipojogoController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['create', 'update', 'delete', 'login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout', 'create', 'update', 'delete', 'login'],
                        'roles' => ['@']
                    ],
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?']
                    ],
                    'denyCallback' => function ($rule, $action) {
                        throw new \Exception('Não tem permissão para aceder a esta página.');
                    }
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tipojogo models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin')) {
            $searchModel = new TipojogoSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Displays a single Tipojogo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->can('admin')) {
            
            $searchModel = new TipojogoSearch();            
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Tipojogo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin')) {
            $model = new Tipojogo();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->Id]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Tipojogo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('admin')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->Id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Tipojogo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->can('admin')) {
            $modelJogo = \app\models\Jogos::find()->where(['id_tipojogo' => $id])->all();
            if (count($modelJogo) > 0) {
                //throw new NotFoundHttpException('The requested page does not exist.');
                throw new \yii\web\NotAcceptableHttpException('Existem jogos associados a esta categoria, por favor edite-os e proceda à eliminação.');
            } else {
                $this->findModel($id)->delete();

                return $this->redirect(['index']);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Tipojogo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tipojogo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Tipojogo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
