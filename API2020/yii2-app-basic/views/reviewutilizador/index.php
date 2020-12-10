<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewutilizadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviewutilizadors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewutilizador-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Reviewutilizador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id_review',
            'Id_Utilizador',
            'Helpful_UnHelpful',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
