<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reviewutilizador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reviewutilizador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id_review')->textInput() ?>

    <?= $form->field($model, 'Id_Utilizador')->textInput() ?>

    <?= $form->field($model, 'Helpful_UnHelpful')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
