<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReviewutilizadorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Review dos utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewutilizador-index row">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <!--<div class="button-index-brackend col-md-2 col-xs-12">
        < ?= Html::a('Criar novo', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="search-index-brackend col-md-12 col-xs-12">
        < ?php echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>-->

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                //'Id_comentario',
                [
                    'attribute' => 'Id_review',
                    'label' => 'Review',
                    'format' => 'raw',
                    'value' => function($data) {
                        return Html::a('<span>ver</span>', ['/review/view', 'id' => $data->Id_review], ['target' => '_blank']);
                    }
                ],
                //'Id_utilizador',
                [
                    'attribute' => 'Id_Utilizador',
                    'label' => 'Utilizador',
                    'value' => 'utilizador.username',
                ],
                [
                    'attribute' => 'Helpful_UnHelpful',
                    'label' => 'Voto',
                    'value' => function($data) {
                        if ($data->Helpful_UnHelpful == 1)
                            return 'Helpful';
                        return 'UnHelpful';
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
