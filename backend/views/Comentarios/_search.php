<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComentariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comentarios-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <!-- < ?= $form->field($model, 'Id') ?>
    
        < ?= $form->field($model, 'Data') ?>-->

    <div class="col-md-10 col-xs-12">
        <?= $form->field($model, 'Descricao')->label('Procurar:') ?>
    </div>
   <!-- <? = $form->field($model, 'Id_utilizador') ?>

    <? = $form->field($model, 'Id_jogo') ?>-->

    <div class="button-search form-group col-md-2 col-xs-12">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <!--< ?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>-->
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
