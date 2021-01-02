<?php

namespace backend\controllers;

use Yii;
use app\models\Comentariosreports;
use app\models\ComentariosreportsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ComentariosreportsController implements the CRUD actions for Comentariosreports model.
 */
class ComentariosreportsController extends Controller {

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
     * Lists all Comentariosreports models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $searchModel = new ComentariosreportsSearch();
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
     * Displays a single Comentariosreports model.
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
     * Creates a new Comentariosreports model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $model = new Comentariosreports();

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
     * Updates an existing Comentariosreports model.
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
     * Deletes an existing Comentariosreports model.
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
     * Finds the Comentariosreports model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Id_comentario
     * @param integer $Id_utilizador
     * @return Comentariosreports the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id_comentario, $Id_utilizador) {
        if (($model = Comentariosreports::findOne(['Id_comentario' => $Id_comentario, 'Id_utilizador' => $Id_utilizador])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
