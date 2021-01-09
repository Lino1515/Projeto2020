<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JogosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Jogos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogos-index">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="button-index-brackend col-md-2 col-xs-12">
        <?= Html::a('Criar novo', ['create'], ['class' => 'btn btn-success', 'name' => 'criarjogo']) ?>
    </div>

    <div class="search-index-brackend col-md-12 col-xs-12">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'id' => 'descricao',
            'options' => ['style' => 'overflow: scroll;'],
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'Id',
                'Nome',
                //'Descricao:ntext',
                [
                    'attribute' => 'Descricao',
                    'label' => 'Descrição',
                    'value' => 'Descricao',
                    'contentOptions' => ['class' => 'truncate'],
                ],
                'Data',
                //'Trailer',
                //'Imagem:image',
                [
                    'label' => 'Imagem',
                    'attribute' => 'Imagem',
                    'format' => 'html',
                    'value' => function($model) {
                        return yii\bootstrap\Html::img($model->Imagem, ['width' => '200', 'height' => '150']);
                    }
                ],
                [
                    'label' => 'Trailer',
                    'attribute' => 'Trailer',
                    'format' => 'raw',
                    'value' => function($model) {
                        $video = \tuyakhov\youtube\EmbedWidget::widget([
                                    'code' => $model->Trailer,
                                    'playerParameters' => [
                                        'controls' => 2
                                    ],
                                    'iframeOptions' => [
                                        'width' => '200',
                                        'height' => '150'
                                    ]
                        ]);

                        return $video;
                    }
                ],
                //'Id_tipojogo',
                [
                    'label' => 'Tipo de jogo',
                    'attribute' => 'Id_tipojogo',
                    'value' => 'tipojogo.Nome',
                ],
                [
                    'class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil btn btn-success"></span>', $url);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Tem a certeza que pretende eliminar o jogo?',
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
