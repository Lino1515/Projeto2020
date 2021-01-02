<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\Tipojog;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jogos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true])->label('Nome:') ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 15])->label('Descrição:') ?>

    <!-- < ?= $form->field($model, 'Data')->textInput() ?>-->


    <br>

    <div class="jogo-data-form col-md-12 col-sm-12">
        <b>Hint:</b>
        <?= Html::img('Imagens/TrailerLinkGuia.jpg', ['alt' => 'Qual codigo']); ?>
        <?= $form->field($model, 'Trailer')->textInput(['maxlength' => true])->hint('Por favor insira somente o codigo do video.')->label('Código do trailer:') ?>
    </div>

    <div class="jogo-data-form col-md-12 col-sm-12">
        <?= $form->field($model, 'Imagem')->fileInput()->label('Upload da imagem:') ?>
    </div>

    <div class="jogo-data-form col-md-6 col-sm-12">
        <?= $form->field($model, 'Data')->textInput(['class' => 'form-control'])->widget(\yii\jui\DatePicker::classname(), ['dateFormat' => 'yyyy-MM-dd'])->label('Data de lançamento:') ?>
    </div>
    <div class="jogo-data-form col-md-6 col-sm-12">
        <?= $form->field($model, 'Id_tipojogo')->dropDownList(ArrayHelper::map($tipojogo, 'Id', 'Nome'), ['prompt' => 'Selecione uma Opção'])->label('Tipo de jogo:') ?>
    </div>

    <div class="form-group col-md-12">
        <?= Html::submitButton('Criar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
