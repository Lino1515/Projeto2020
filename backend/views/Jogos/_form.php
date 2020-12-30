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

    <?= $form->field($model, 'Nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Descricao')->textarea(['rows' => 25]) ?>

    <!-- < ?= $form->field($model, 'Data')->textInput() ?>-->
    <?=
    $form->field($model, 'Data')->textInput()->widget(\yii\jui\DatePicker::classname(), [
        //'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ])
    ?>

    <?= $form->field($model, 'Trailer')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'Imagem')->fileInput() ?>

    <?= $form->field($model, 'Id_tipojogo')->dropDownList(ArrayHelper::map($tipojogo, 'Id', 'Nome'), ['prompt' => 'Selecione uma Opção'])->label('Tipo de jogo:') ?>

    <div class="form-group">
        <?= Html::submitButton('Criar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
