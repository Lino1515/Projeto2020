<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Reviewreports */

$this->title = "Report do review com id " . $model->Id_review;
$this->params['breadcrumbs'][] = ['label' => 'Reviewreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reviewreports-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12" >
        <div class="col-md-12 col-xs-12">
            <p class="descricao-index-brackend" style="text-align: justify;">
                O utilizador com o nome de <b><?= $model->utilizador->username ?></b> foi reportado no dia <b><?= $model->Data ?></b> pelo seguinte comentário.
            </p>
            <p class="descricao-index-brackend" style="text-align: justify;">
                <b>Review:</b> <?= $model->Descricao ?>
            </p> 
        </div>
    </div>

    <br> 
    <div class="col-md-12 col-xs-12" style="text-align: center;">
        <br>       
        <p>
        <!--<? = Html::a('Update', ['update', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador], ['class' => 'btn btn-primary']) ?>-->
            <?=
            Html::a('Delete', ['delete', 'Id_review' => $model->Id_review, 'Id_utilizador' => $model->Id_utilizador], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Pretende eliminar este item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>
    </div>
    <p>
    </p>


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
                    'class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}', //{update}
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
