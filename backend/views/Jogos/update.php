<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */

$this->title = 'Update do Jogo: ' . $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jogos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'tipojogo' => $tipojogo,]) ?>

</div>
