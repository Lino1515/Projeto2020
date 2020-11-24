<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <!--< ?= $form->field($model, 'Id') ?>

    < ?= $form->field($model, 'Data') ?>-->

    <div class="col-md-10 col-xs-12">
        <!-- < ?= $form->field($model, 'Descricao') ?>

    <!--< ?= $form->field($model, 'Score') ?>-->

        <?= $form->field($model, 'Id_Jogo') ?>
    </div>

    <div class="button-search form-group col-md-2 col-xs-12">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!--< ?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>-->
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
