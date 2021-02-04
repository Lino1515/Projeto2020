<?php

namespace app\modules\v1\controllers;

use Yii;
use app\models\Uploadimagem;
use app\models\UploadimagemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\QueryParamAuth;
use yii\base\ActionFilter;
use yii\app;
use app\models\User;
use yii\web\ForbiddenHttpException;
use yii\rest\ActiveController;

/**
 * UploadImagemController implements the CRUD actions for UploadImagem model.
 */
class UploadimagemController extends ActiveController {

    public $modelClass = 'app\modules\v1\models\Uploadimagem';

    public function actionUploadimagem($id) {
       $result = \app\modules\v1\models\Uploadimagem::find()->where(["id_user" => $id])->all();
        return $result;
    }

}
