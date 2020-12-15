<?php

namespace app\modules\v1\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends \yii\rest\ActiveController {

    public $modelClass = 'app\v1\models\tipojogo';

    /**
     * Renders the index view for the module
     * @return string
     */
    /* public function actionIndex()
      {
      return $this->render('index');
      } */
}
