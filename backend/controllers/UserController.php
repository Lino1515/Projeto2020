<?php

namespace backend\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        if (Yii::$app->user->can('admin')) {
            $searchModel = new UserSearch();
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
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        if (Yii::$app->user->can('admin')) {
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('view', [
                        'model' => $this->findModel($id),
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /* public function actionCreate() {
      if (Yii::$app->user->can('admin')) {
      $model = new User();

      if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
      }

      return $this->render('create', [
      'model' => $model,
      ]);
      } else {
      throw new ForbiddenHttpException;
      }
      } */

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        if (Yii::$app->user->can('admin')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        if (Yii::$app->user->can('admin')) {

            $modelComent = \app\models\Comentarios::find()->where(['Id_utilizador' => $id])->all();
            //CORRE E ELIMINA TODOS OS COMENTARIOS ASSOCIADOS A ESTE JOGO
            for ($q = 0; $q < count($modelComent); $q++) {
                $modelComentUser = \app\models\Comentariosutilizador::find()->where(['id_comentario' => $modelComent[$q]->Id])->all();
                //CORRE E ELIMINA TODOS OS COMENTARIOS UTILIZADORES ASSOCIADOS A ESTE COMENTARIO
                for ($w = 0; $w < count($modelComentUser); $w++) {
                    $modelComentUser[$w]->delete();
                }
                $modelComentReport = \app\models\Comentariosreports::find()->where(['id_comentario' => $modelComent[$q]->Id])->all();
                //CORRE E ELIMINA TODOS OS COMENTARIOS REPORTS ASSOCIADOS A ESTE COMENTARIO
                for ($e = 0; $e < count($modelComentReport); $e++) {
                    $modelComentReport[$e]->delete();
                }
                $modelComent[$q]->delete();
            }
            $modelReview = \app\models\Review::find()->where(['id_jogo' => $id])->all();
            //CORRE E ELIMINA TODOS OS REVIEWS ASSOCIADOS A ESTE JOGO
            for ($r = 0; $r < count($modelReview); $r++) {
                $modelReviewUser = \app\models\Reviewutilizador::find()->where(['id_review' => $modelReview[$r]->Id])->all();
                //CORRE E ELIMINA TODOS OS REVIEWS UTILIZADORES ASSOCIADOS A ESTE COMENTARIO
                for ($t = 0; $t < count($modelReviewUser); $t++) {
                    $modelReviewUser[$t]->delete();
                }
                $modelReviewReport = \app\models\Reviewreports::find()->where(['id_review' => $modelReview[$r]->Id])->all();
                //CORRE E ELIMINA TODOS OS REVIEWS REPORTS ASSOCIADOS A ESTE COMENTARIO
                for ($y = 0; $y < count($modelReviewUser); $y++) {
                    $modelReviewReport[$y]->delete();
                }
                $modelReview[$r]->delete();
            }
            $auth = \app\models\AuthAssignment::find()->where(['user_id' => $id])->all();
            $auth[0]->delete();

            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
