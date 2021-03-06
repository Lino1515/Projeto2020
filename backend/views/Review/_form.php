<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Review */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Data')->textInput(['value' => date('Y-m-d'), 'readonly' => true])->label('Data:') ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 6])->label('Descrição:') ?>

    <?= $form->field($model, 'Score')->textInput(['type' => 'number', 'min' => "0", 'max' => "10", 'step' => '0.01'])->label('Score:') ?>

    <?= $form->field($model, 'Id_Jogo')->dropDownList(ArrayHelper::map(app\models\Jogos::find()->all(), 'Id', 'Nome'), ['prompt' => 'selecione um jogo'])->label('Jogo: ') ?>

    <?= $form->field($model, 'Id_Utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'enviarform']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
