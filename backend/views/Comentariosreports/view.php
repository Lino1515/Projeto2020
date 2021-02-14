<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosreports */

$this->title = "Report do comentário com id " . $model->Id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentariosreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="comentariosreports-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="grid-index-brackend col-md-12 col-xs-12" >
        <div class="col-md-12 col-xs-12">
            <p class="descricao-index-brackend" style="text-align: justify;">
                O utilizador com o nome de <b><?= $model->utilizador->username ?></b> foi reportado no dia <b><?= $model->Data ?></b> pelo seguinte comentário.
            </p>
            <p class="descricao-index-brackend" style="text-align: justify;">
                <b>Comentário:</b> <?= $model->Descricao ?>
            </p> 
        </div>
    </div>

    <br> 
    <div class="col-md-12 col-xs-12" style="text-align: center;">
        <br>       
        <p>
            <?=
            Html::a('Delete', ['delete', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Pretende eliminar este item?',
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
