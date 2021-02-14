<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Review */

$this->title = "Atualização da review com id " . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="review-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <div class="grid-index-brackend col-md-12 col-xs-12" >
        <div class="col-md-12 col-xs-12">
            <p class="descricao-index-brackend" style="text-align: justify;">
                <b>Comentário:</b> <?= $model->Descricao ?>
            </p>  
            <p class="descricao-index-brackend" style="text-align: justify;">
                <b>Score:</b> <?= $model->Score ?>
            </p> 
            <p class="descricao-index-brackend" style="text-align: justify;">
                <b>Data:</b> <?= $model->Data ?>
            </p>
            <p class="descricao-index-brackend" style="text-align: justify;">
                <b>Username:</b> <?= $model->utilizador->username ?>
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
                    'confirm' => 'Tem a certeza que pretende eliminar a review?',
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
                // 'Id',
                'Data',
                'Descricao:ntext',
                'Score',
                //'Id_Jogo',
                [
                    'attribute' => 'Id_Jogo',
                    'value' => 'jogo.Nome',
                    'label' => 'Nome do jogo',
                ],
                //'Id_Utilizador',
                [
                    'attribute' => 'Id_Utilizador',
                    'value' => 'utilizador.username',
                    'label' => 'Nome de utilizador',
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
                                            'confirm' => 'Tem a certeza que pretende eliminar a review?',
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
