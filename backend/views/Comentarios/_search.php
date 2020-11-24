<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComentariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<!-- < ?= $form->field($model, 'Id') ?>

    < ?= $form->field($model, 'Data') ?>-->

    <?= $form->field($model, 'Descricao') ?>

    <?= $form->field($model, 'Id_utilizador') ?>

    <?= $form->field($model, 'Id_jogo') ?>

    <div class="button-search form-group col-md-2 col-xs-12">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <!--< ?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>-->
        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
