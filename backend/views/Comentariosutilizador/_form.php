<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosutilizador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentariosutilizador-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id_comentario')->textInput() ?>

    <?= $form->field($model, 'Id_utilizador')->textInput() ?>

    <?= $form->field($model, 'Like_Dislike')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
