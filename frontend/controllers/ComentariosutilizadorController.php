<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Comentariosutilizador;
use frontend\models\ComentariosutilizadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComentariosutilizadorController implements the CRUD actions for Comentariosutilizador model.
 */
class ComentariosutilizadorController extends Controller
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
     * Lists all Comentariosutilizador models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComentariosutilizadorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Comentariosutilizador model.
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
     * Creates a new Comentariosutilizador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Comentariosutilizador();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Comentariosutilizador model.
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
     * Deletes an existing Comentariosutilizador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id_comentario, $Id_utilizador)
    {
        $this->findModel($Id_comentario, $Id_utilizador)->delete();

        return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }

    /**
     * Finds the Comentariosutilizador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return Comentariosutilizador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_comentario, $Id_utilizador)
    {
        if (($model = Comentariosutilizador::findOne(['Id_comentario' => $Id_comentario, 'Id_utilizador' => $Id_utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
