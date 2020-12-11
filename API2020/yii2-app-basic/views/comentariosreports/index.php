<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentariosreportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentariosreports';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosreports-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comentariosreports', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id_comentario',
            'Id_utilizador',
            'Data',
            'Descricao:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>