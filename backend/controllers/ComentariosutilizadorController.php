<?php

namespace backend\controllers;

use Yii;
use app\models\Comentariosutilizador;
use app\models\ComentariosutilizadorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ComentariosutilizadorController implements the CRUD actions for Comentariosutilizador model.
 */
class ComentariosutilizadorController extends Controller {

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
     * Lists all Comentariosutilizador models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $searchModel = new ComentariosutilizadorSearch();
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
     * Displays a single Comentariosutilizador model.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id_comentario, $Id_utilizador) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            return $this->render('view', [
                        'model' => $this->findModel($Id_comentario, $Id_utilizador),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new Comentariosutilizador model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $model = new Comentariosutilizador();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Comentariosutilizador model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id_comentario, $Id_utilizador) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $model = $this->findModel($Id_comentario, $Id_utilizador);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing Comentariosutilizador model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id_comentario, $Id_utilizador) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $this->findModel($Id_comentario, $Id_utilizador)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Comentariosutilizador model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return Comentariosutilizador the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_comentario, $Id_utilizador) {
        if (($model = Comentariosutilizador::findOne(['Id_comentario' => $Id_comentario, 'Id_utilizador' => $Id_utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
