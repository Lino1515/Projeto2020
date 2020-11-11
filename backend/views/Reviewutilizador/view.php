<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reviewutilizador */

$this->title = $model->Id_review;
$this->params['breadcrumbs'][] = ['label' => 'Reviewutilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reviewutilizador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Id_review' => $model->Id_review, 'Id_Utilizador' => $model->Id_Utilizador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Id_review' => $model->Id_review, 'Id_Utilizador' => $model->Id_Utilizador], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id_review',
            'Id_Utilizador',
            'Helpful_UnHelpful',
        ],
    ]) ?>

</div>
