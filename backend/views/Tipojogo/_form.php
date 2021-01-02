<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tipojogo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipojogo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true])->label('Nome:') ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 15, ])->label('Descrição: ') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
