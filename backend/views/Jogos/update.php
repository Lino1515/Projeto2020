<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */

$this->title = 'Update: ' . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jogos-update">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?= $this->render('_form', ['model' => $model, 'tipojogo' => $tipojogo,]) ?>
    </div>
</div>
