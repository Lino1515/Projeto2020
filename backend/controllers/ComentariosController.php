<?php

namespace backend\controllers;

use Yii;
use app\models\Comentarios;
use app\models\ComentariosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * ComentariosController implements the CRUD actions for Comentarios model.
 */
class ComentariosController extends Controller {

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
     * Lists all Comentarios models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $searchModel = new ComentariosSearch();
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
     * Displays a single Comentarios model.
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
     * Creates a new Comentarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $model = new Comentarios();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Updates an existing Comentarios model.
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
     * Deletes an existing Comentarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->can('admin') or Yii::$app->user->can('moderador')) {
            $modelComentUser = \app\models\Comentariosutilizador::find()->where(['id_comentario' => $id])->all();
            for ($j = 0; $j < count($modelComentUser); $j++) {

                $modelComentUser[$j]->delete();
            }
            $modelComentReport = \app\models\Comentariosreports::find()->where(['id_comentario' => $id])->all();
            for ($i = 0; $i < count($modelComentReport); $i++) {

                $modelComentReport[$i]->delete();
            }
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the Comentarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Comentarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Comentarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
