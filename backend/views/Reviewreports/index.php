<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewreportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports das reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewreports-index row">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <!--<div class="button-index-brackend col-md-2 col-xs-12">
        < ?= Html::a('Criar novo', ['create'], ['class' => 'btn btn-success']) ?>
    </div>-->

    <div class="search-index-brackend col-md-12 col-xs-12">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'Id_review',
                    [
                    'attribute' => 'Id_review',
                    'label' => 'Reviews',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a('<span>ver</span>', ['/review/view', 'id' => $data->Id_review], ['target' => '_blank']);
                    }
                ],
                    [
                    'attribute' => 'Id_utilizador',
                    'label' => 'Username',
                    'value' => 'utilizador.username',
                ],
                'Data',
                    [
                    'attribute' => 'Descricao',
                    'label' => 'Descrição',
                    'value' => 'Descricao',
                ],
                //'Descricao:ntext',
                [
                    'class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}',//{update}
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil btn btn-success"></span>', $url);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Tem a certeza que pretende eliminar?',
                                            'method' => 'post',
                            ]]);
                        },
                        'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open btn btn-primary"></span>', $url);
                        },
                    ],
                ],
            ],
        ]);
        ?>
    </div>

</div>
