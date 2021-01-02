<?php

namespace backend\controllers;

use Yii;
use backend\models\Jogos;
use backend\models\user;
use app\models\Review;
use app\models\ReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ReviewController implements the CRUD actions for Review model.
 */
class ReviewController extends Controller {

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
     * Lists all Review models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $searchModel = new ReviewSearch();
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
     * Displays a single Review model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Review model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $model = new Review();
            if ($model->load(Yii::$app->request->post())) {
                $model->save();
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
     * Updates an existing Review model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
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
     * Deletes an existing Review model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            //CORRE E ELIMINA TODAS AS REVIEWS UTILIZADORES
            $modelReviewUser = \app\models\Reviewutilizador::find()->where(['id_review' => $id])->all();
            for ($i = 0; $i < count($modelReviewUser); $i++)
                $modelReviewUser[$i]->delete();
            //CORRE E ELIMINA TODAS AS REVIEWS REPORTS
            $modelReviewReport = \app\models\Reviewreports::find()->where(['id_review' => $id])->all();
            for ($j = 0; $j < count($modelReviewUser); $j++)
                $modelReviewReport[$j]->delete();
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Review model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Review the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Review::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
