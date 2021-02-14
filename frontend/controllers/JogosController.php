<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Jogos;
//use app\models\Jogos;
use frontend\models\JogosSearch;
//use app\models\JogosSearch;
use yii\web\Controller;
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

        $searchModel = new JogosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //var_dump($dataProvider->models);exit;

        $todosJogos = Jogos::find()->orderBy('Nome')->all();
        $todosTipojogos = \frontend\models\Tipojogo::find()->orderBy('Nome')->all();

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'todosJogos' => $todosJogos,
                    'todosTipojogos' => $todosTipojogos
        ]);
    }

    /**
     * Displays a single Jogos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {

        $coment = \frontend\models\Comentarios::find()->where(['Id_jogo' => $id])->orderBy('Data DESC')->all();
        $reviews = \frontend\models\Review::find()->where(['Id_jogo' => $id])->orderBy('Data DESC')->all();

        //$comentUser = \frontend\models\comentariosutilizador::find()->where(['Id_jogo' => $id])->all();

        $tipojogo = \frontend\models\Tipojogo::find()->orderBy('Nome')->asArray()->all();

        $modelComent = new \frontend\models\Comentarios();
        $modelReview = new \frontend\models\Review();
        $modelComentUser = new \frontend\models\comentariosutilizador();
        $modelreviewUser = new \frontend\models\Reviewutilizador();

        return $this->render('view', [
                    'model' => $this->findModel($id),
                    'coment' => $coment, //done
                    //'comentUser' => $comentUser,
                    'reviews' => $reviews, //done
                    'tipojogo' => $tipojogo, //done
                    'modelComent' => $modelComent, //done
                    'modelReview' => $modelReview, //done
                    'modelComentUser' => $modelComentUser,
                    'modelreviewUser' => $modelreviewUser,
        ]);
    }

    /**
     * Creates a new Jogos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Jogos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Jogos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Jogos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
