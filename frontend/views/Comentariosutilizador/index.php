<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentariosutilizadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentariosutilizadors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosutilizador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comentariosutilizador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id_comentario',
            'Id_utilizador',
            'Like_Dislike',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
