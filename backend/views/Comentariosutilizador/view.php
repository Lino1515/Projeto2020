<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosutilizador */

$this->title = $model->Id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentariosutilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comentariosutilizador-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador], [
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
            'Id_comentario',
            'Id_utilizador',
            'Like_Dislike',
        ],
    ]) ?>

</div>
