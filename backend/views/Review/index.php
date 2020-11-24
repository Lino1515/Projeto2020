<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="review-index row">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="button-index-brackend col-md-2 col-xs-12">
        <?= Html::a('Create Review', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="search-index-brackend col-md-12 col-xs-12">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'Id',
            'Data',
            'Descricao:ntext',
            'Score',
            //'Id_Jogo',
            [
                'attribute' => 'Id_Jogo',
                'value'=>'jogos.Nome',
                'label' => 'Nome do jogo',
            ],
            //'Id_Utilizador',
            [
                'attribute' => 'Id_Utilizador',
                'value'=>'user.username',
                'label' => 'Nome de utilizador',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>

</div>
