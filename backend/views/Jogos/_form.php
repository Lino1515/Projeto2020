<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jogos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 6])->textArea() ?>

    <?= $form->field($model, 'Data')->textInput() ?>
    <?= $form->field($model, 'Data')->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        //'dateFormat' => 'yyyy-MM-dd',
    ]) ?>

    <?= $form->field($model, 'Trailer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Imagem')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Id_tipojogo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
