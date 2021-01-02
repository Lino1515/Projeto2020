<?php

namespace app\modules\v1\controllers;

use yii\web\Controller;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends \yii\rest\ActiveController {

    public $modelClass = 'app\modules\v1';

    /**
     * Renders the index view for the module
     * @return string
     */
    /* public function actionIndex()
      {
      return $this->render('index');
      } */
}
