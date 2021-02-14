<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComentariosutilizadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comentários do utilizador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosutilizador-index row">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'Id_comentario',
                [
                    'attribute' => 'Id_comentario',
                    'label' => 'Comentario',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a('<span>ver</span>', ['/comentarios/view', 'id' => $data->Id_comentario], ['target' => '_blank']);
                    }
                ],
                //'Id_utilizador',
                [
                    'attribute' => 'Id_utilizador',
                    'label' => 'Utilizador',
                    'value' => 'utilizador.username',
                ],
                [
                    'attribute' => 'Like_Dislike',
                    'label' => 'Voto',
                    'value' => function($data) {
                        if ($data->Like_Dislike == 1)
                            return 'Like';
                        return 'Dislike';
                    },
                ],
                //'Like_Dislike',
                [
                    'class' => 'yii\grid\ActionColumn', 'template' => '{delete}', //{update}
                    'buttons' => [
                        /* 'update' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil btn btn-success"></span>', $url);
                          }, */
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Tem a certeza que pretende eliminar?',
                                            'method' => 'post',
                            ]]);
                        },
                    /* 'view' => function ($url, $model) {
                      return Html::a('<span class="glyphicon glyphicon-eye-open btn btn-primary"></span>', $url);
                      }, */
                    ],
                ],
            ],
        ]);
        ?>
    </div>

</div>
