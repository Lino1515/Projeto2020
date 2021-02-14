<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Tipojog;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    <!-- < ?= $form->field($model, 'password_hash')->textInput(['maxlength' => true, 'readonly' => true]) ?>
    < ?= $form->field($model, 'username')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    < ?= $form->field($model, 'created_at')->textInput(['readonly' => true]) ?>

    < ?= $form->field($model, 'updated_at')->textInput(['readonly' => true]) ?>
   < ?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true, 'readonly' => true]) ?>-->

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['10' => 'ATIVO', '9' => 'INATIVO', '0' => 'ELIMINADO']);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
