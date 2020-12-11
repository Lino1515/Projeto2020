<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviewutilizador */

$this->title = 'Update Reviewutilizador: ' . $model->Id_review;
$this->params['breadcrumbs'][] = ['label' => 'Reviewutilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_review, 'url' => ['view', 'Id_review' => $model->Id_review, 'Id_Utilizador' => $model->Id_Utilizador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reviewutilizador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
