<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utilizadores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index row" style="overflow:auto;">

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
                // 'id',
                'username',
                'email',
                    [
                    'attribute' => 'status',
                    'label' => 'Estado',
                    'value' => function($data) {
                        if ($data->status == 10)
                            return 'ATIVO';
                        if ($data->status == 9)
                            return 'INATIVO';
                        if ($data->status == 0)
                            return 'ELIMINADO';
                        return 'ERRO!';
                    },
                ],
                /* [
                  'attribute' => 'auth_key',
                  'label' => 'Chave de autenticação',
                  'value' => 'auth_key',
                  'contentOptions' => ['class' => 'truncate-user'],
                  ], */
                //'auth_key',
                /* [
                  'attribute' => 'password_hash',
                  'label' => 'Password Hash',
                  'value' => 'password_hash',
                  'contentOptions' => ['class' => 'truncate-user'],
                  ], */
                /* [
                  'attribute' => 'verification_token',
                  'label' => 'Token de verificação',
                  'value' => 'verification_token',
                  'contentOptions' => ['class' => 'truncate-user'],
                  ], */
                //'password_hash',
                //'email:email',
                //'status',
                //'created_at',
                //'updated_at',
                //'verification_token',
                // ['class' => 'yii\grid\ActionColumn'],
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
                                            'confirm' => 'Tem a certeza que pretende eliminar o utilizador?',
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