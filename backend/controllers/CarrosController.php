<?php

namespace backend\controllers;

use app\models\Carros;
use yii\web\Controller;
use Yii;

use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CarrosController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'only' => ['view', 'login', 'logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout', 'view'],
                        'roles' => ['@']
                    ],
                    'denyCallback' => function ($rule, $action) {
                        throw new \Exception('Não tem permissão para aceder a esta página.');
                    }
                ]
            ],
        ];
    }

    public function actionView() {
        if (Yii::$app->user->can('admin')) {
            $carrosCont = Carros::find()->all();

            return $this->render('view', [
                        'carrostoais' => count($carrosCont),
            ]);
        } else {
            throw new ForbiddenHttpException;
        }
    }

}
