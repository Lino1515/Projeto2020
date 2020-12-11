<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ComentariosreportsSearch */

$this->title = $model->Id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentariosreports Searches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comentariosreports-search-view">

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
            'Data',
            'Descricao:ntext',
        ],
    ]) ?>

</div>
