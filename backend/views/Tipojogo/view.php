<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Tipojogo */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Tipojogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tipojogo-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($model->Nome) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12" >
        <div class="col-md-12 col-xs-12">
            <p class="descricao-index-brackend" style="text-align: justify;">
                <?= $model->Descricao ?>
            </p>
        </div>
    </div>

    <br> 

    <div class="col-md-12 col-xs-12" style="text-align: center;">
        <br>
        <p>
            <?= Html::a('Atualizar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Eliminar', ['delete', 'id' => $model->Id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende eliminar o tipo de jogo?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
    </div>
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1>Outros</h1>
    </div>
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
                //'Id',
                'Nome',
                'Descricao:ntext',
                /* [
                  'attribute' => 'Descricao',
                  'label' => 'Descrição',
                  'value' => 'Descricao',
                  'contentOptions' => ['class' => 'truncate'],
                  ], */
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
