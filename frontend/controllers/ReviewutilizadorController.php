<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Reviewutilizador;
use frontend\models\ReviewutilizadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReviewutilizadorController implements the CRUD actions for Reviewutilizador model.
 */
class ReviewutilizadorController extends Controller
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
     * Lists all Reviewutilizador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReviewutilizadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reviewutilizador model.
     * @param integer $Id_review
     * @param integer $Id_Utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id_review, $Id_Utilizador)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id_review, $Id_Utilizador),
        ]);
    }

    /**
     * Creates a new Reviewutilizador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reviewutilizador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reviewutilizador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Id_review
     * @param integer $Id_Utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id_review, $Id_Utilizador)
    {
        $model = $this->findModel($Id_review, $Id_Utilizador);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id_review' => $model->Id_review, 'Id_Utilizador' => $model->Id_Utilizador]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reviewutilizador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Id_review
     * @param integer $Id_Utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id_review, $Id_Utilizador)
    {
        $this->findModel($Id_review, $Id_Utilizador)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reviewutilizador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_review
     * @param integer $Id_Utilizador
     * @return Reviewutilizador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_review, $Id_Utilizador)
    {
        if (($model = Reviewutilizador::findOne(['Id_review' => $Id_review, 'Id_Utilizador' => $Id_Utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
