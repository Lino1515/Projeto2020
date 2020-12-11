<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Data')->textInput() ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'Id_utilizador')->textInput() ?>

    <?= $form->field($model, 'Id_jogo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
