<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Data')->textInput() ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Score')->textInput() ?>

    <?= $form->field($model, 'Id_Jogo')->textInput() ?>

    <?= $form->field($model, 'Id_Utilizador')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
