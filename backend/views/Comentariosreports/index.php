<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentariosreportsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reports dos comentários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosreports-index row">

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
                // ['class' => 'yii\grid\SerialColumn'],
                // 'Id_comentario',
                    [
                    'attribute' => 'Id_comentario',
                    'label' => 'Comentario',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a('<span>ver</span>', ['/comentarios/view', 'id' => $data->Id_comentario], ['target' => '_blank']);
                    }
                ],
                    [
                    'attribute' => 'Id_utilizador',
                    'label' => 'Username',
                    'value' => 'utilizador.username',
                ],
                'Data',
                'Descricao:ntext',
                    [
                    'class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}', //{update} 
                    'buttons' => [
                        /* 'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil btn btn-success"></span>', $url);
                          }, */
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Tem a certeza que pretende eliminar o report?',
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
