<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <div class="col-md-10 col-xs-12">
    <?= $form->field($model, 'username')->textInput()->label('Procurar:') ?>
    </div>
        <?php //$form->field($model, 'Descricao')  ?>
    <div class="button-search form-group col-md-2 col-xs-12">
        <?= Html::submitButton('Procurar', ['class' => 'btn btn-primary']) ?>
        <!--<? Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary'], ['value' => ''], ['type' => 'reset']) ?>-->
        <!-- < ?= \yii\helpers\Html::a('Voltar', Yii::$app->request->referrer); ?>-->
    <?= Html::a('Limpar', ['index'], ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>

</div>
