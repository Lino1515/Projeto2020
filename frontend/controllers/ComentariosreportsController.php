<?php

namespace app\controllers;

use Yii;
use app\models\Comentariosreports;
use app\models\ComentariosreportsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentariosreportsController implements the CRUD actions for Comentariosreports model.
 */
class ComentariosreportsController extends Controller
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
     * Lists all Comentariosreports models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComentariosreportsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comentariosreports model.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id_comentario, $Id_utilizador)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id_comentario, $Id_utilizador),
        ]);
    }

    /**
     * Creates a new Comentariosreports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comentariosreports();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comentariosreports model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id_comentario, $Id_utilizador)
    {
        $model = $this->findModel($Id_comentario, $Id_utilizador);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Comentariosreports model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id_comentario, $Id_utilizador)
    {
        $this->findModel($Id_comentario, $Id_utilizador)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Comentariosreports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return Comentariosreports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_comentario, $Id_utilizador)
    {
        if (($model = Comentariosreports::findOne(['Id_comentario' => $Id_comentario, 'Id_utilizador' => $Id_utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
