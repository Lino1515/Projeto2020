<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviewreports */

$this->title = 'Update Reviewreports: ' . $model->Id_review;
$this->params['breadcrumbs'][] = ['label' => 'Reviewreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_review, 'url' => ['view', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reviewreports-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
