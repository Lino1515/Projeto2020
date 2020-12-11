<?php

namespace app\controllers;

use Yii;
use app\models\Reviewreports;
use app\models\ReviewreportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewreportsController implements the CRUD actions for Reviewreports model.
 */
class ReviewreportsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
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
    public function actionIndex()
    {
        $searchModel = new ReviewreportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reviewreports model.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id_review, $Id_utilizador)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id_review, $Id_utilizador),
        ]);
    }

    /**
     * Creates a new Reviewreports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reviewreports();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reviewreports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id_review, $Id_utilizador)
    {
        $model = $this->findModel($Id_review, $Id_utilizador);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reviewreports model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id_review, $Id_utilizador)
    {
        $this->findModel($Id_review, $Id_utilizador)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reviewreports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_review
     * @param integer $Id_utilizador
     * @return Reviewreports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_review, $Id_utilizador)
    {
        if (($model = Reviewreports::findOne(['Id_review' => $Id_review, 'Id_utilizador' => $Id_utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}