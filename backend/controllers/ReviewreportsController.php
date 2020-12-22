<?php

namespace backend\controllers;

use Yii;
use app\models\Reviewreports;
use app\models\ReviewreportsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ReviewreportsController implements the CRUD actions for Reviewreports model.
 */
class ReviewreportsController extends Controller {

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
     * Lists all Reviewreports models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('admin')) {
            $searchModel = new ReviewreportsSearch();
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
     * Displays a single Reviewreports model.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id_review, $Id_utilizador) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('admin')) {
            return $this->render('view', [
                        'model' => $this->findModel($Id_review, $Id_utilizador),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Reviewreports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('admin')) {
            $model = new Reviewreports();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Reviewreports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id_review, $Id_utilizador) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('admin')) {
            $model = $this->findModel($Id_review, $Id_utilizador);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Reviewreports model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id_review, $Id_utilizador) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('admin')) {
            $this->findModel($Id_review, $Id_utilizador)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Reviewreports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return Reviewreports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_review, $Id_utilizador) {
        if (($model = Reviewreports::findOne(['Id_review' => $Id_review, 'Id_utilizador' => $Id_utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
