<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReviewutilizadorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviewutilizador-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

   <!-- < ?= $form->field($model, 'Id_review') ?>-->

    <div class="col-md-10 col-xs-12">

        <?= $form->field($model, 'Id_Utilizador') ?>
    </div>
   <!-- < ?= $form->field($model, 'Helpful_UnHelpful') ?>-->

    <div class="button-search form-group col-md-2 col-xs-12">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!--<? Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary'], ['value' => ''], ['type' => 'reset']) ?>-->
        <!-- < ?= \yii\helpers\Html::a('Voltar', Yii::$app->request->referrer); ?>-->
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
