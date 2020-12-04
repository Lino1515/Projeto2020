<?php

namespace backend\controllers;

use Yii;
use app\models\Jogos;
//use backend\models\Tipojogo;
use app\models\Tipojogo;
use app\models\JogosSearch;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JogosController implements the CRUD actions for Jogos model.
 */
class JogosController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all Jogos models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin'))
        {
        $searchModel = new JogosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /**
     * Displays a single Jogos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        if (Yii::$app->user->can('admin'))
        {
            $tipojogo = Tipojogo::find()->orderBy('Nome')->asArray()->all();
            return $this->render('view', [
                'model' => $this->findModel($id),
                'tipojogo' => $tipojogo,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }


        /**
     * Creates a new Jogos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin'))
        {
            $model = new Jogos();
            $tipojogo = Tipojogo::find()->orderBy('Nome')->asArray()->all();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->Id]);
            }

            return $this->render('create', [
                'model' => $model,
                'tipojogo' => $tipojogo,
            ]);
        $model = new Jogos();
        $tipojogo = Tipojogo::find()->orderBy('Nome')->asArray()->all();
        $genero = 2;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /**
     * Updates an existing Jogos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('admin'))
        {
            $model = $this->findModel($id);
            $tipojogo = Tipojogo::find()->all();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->Id]);
            }

            return $this->render('update', [
                'model' => $model,
                'tipojogo' => $tipojogo,
            ]);
        }
        else
            throw new ForbiddenHttpException;
    }

    /**
     * Deletes an existing Jogos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->can('admin'))
        {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
        }
        else
            throw new ForbiddenHttpException;

    }

    /**
     * Finds the Jogos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Jogos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Jogos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
