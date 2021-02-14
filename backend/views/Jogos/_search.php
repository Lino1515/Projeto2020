<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JogosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jogos-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <!--< ?= $form->field($model, 'Id') ?>-->

    <div class="col-md-10 col-xs-12">
        <?= $form->field($model, 'Nome')->label('Procurar:') ?>
    </div>

    <!--< ?= $form->field($model, 'Descricao') ?>-->

    <!--< ?= $form->field($model, 'Data') ?>-->

    <!--< ?= $form->field($model, 'Trailer') ?>-->

    <!--< ?php // echo $form->field($model, 'Imagem') ?>-->

    <!-- < ?php // echo $form->field($model, 'Id_tipojogo') ?>-->

    <div class="button-search form-group col-md-2 col-xs-12">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <!--< ?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>-->
        <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
