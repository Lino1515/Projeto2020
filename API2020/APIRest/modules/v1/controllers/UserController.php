<?php

namespace app\modules\v1\controllers;

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
class UserController extends \yii\rest\ActiveController {

    public $modelClass = 'app\modules\v1\models\user';

    public function actionLoginuser($username, $password) {

        $model = new $this->modelClass;

        $user = \app\models\User::findByUsername($username);

        if ($user && $user->validatePassword($password)) {
            $results = $model::find()->where(['username' => $username])->one();
            return $results;
        }
        return null;
    }

    public function actionBot() {
        $limit = 5;
        $model = new $this->modelClass;
        $results = $model::find()->limit($limit)->orderBy(['Data' => SORT_ASC, 'Nome' => SORT_ASC])->all();
        return['limite' => $limit, 'results' => $results];
    }

}
