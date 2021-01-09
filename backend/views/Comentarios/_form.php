<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Data')->textInput(['value' => date('Y-m-d'), 'readonly' => true])->label('Data:') ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 6])->label('Descrição:') ?>

    <?= $form->field($model, 'Id_jogo')->dropDownList(ArrayHelper::map(app\models\Jogos::find()->all(), 'Id', 'Nome'), ['prompt' => 'selecione um jogo'])->label('Jogo:') ?>
    <!--< ?= $form->field($model, 'Id_utilizador')->textInput() ?>-->
    <?= $form->field($model, 'Id_utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>
    <!--<? = $form->field($model, 'Id_utilizador')->dropDownList(ArrayHelper::map(user::find()->all(), 'id', 'username'), ['prompt' => 'select']) ?>-->

    <!--< ?= $form->field($model, 'Id_jogo')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'enviarform']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
