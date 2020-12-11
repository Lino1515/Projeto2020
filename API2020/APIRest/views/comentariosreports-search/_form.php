<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComentariosreportsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentariosreports-search-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Id_comentario')->textInput() ?>

    <?= $form->field($model, 'Id_utilizador')->textInput() ?>

    <?= $form->field($model, 'Data')->textInput() ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
