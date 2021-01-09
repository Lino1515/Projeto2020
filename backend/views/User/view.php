<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$p = \app\models\Authassignment::find()->where(['user_id' => $model->id])->all();
?>
<div class="user-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12" >
        <div class="col-md-12 col-xs-12">
           <!-- <p class="descricao-index-brackend" style="text-align: justify;">
                < ?= $model->username ?>
            </p>-->
            <p>
                <b>Email: </b><?= $model->email ?>
            </p>

            <p>
                <b>Estado: </b>
                <?php
                if ($model->status == 10)
                    echo 'ATIVO';
                if ($model->status == 9)
                    echo 'INATIVO';
                if ($model->status == 0)
                    echo 'ELIMINADO';
                ?>
            </p>

            <p>
                <b>Chave de autenticação: </b> <?= $model->auth_key; ?>
            </p>

            <p>
                <b>Token de verificação: </b> <?= $model->verification_token; ?>
            </p>
        </div>
    </div>

    <!--   < ?=
       DetailView::widget([
           'model' => $model,
           'attributes' => [
               // 'id',
               'username',
               //'auth_key', 
               [
                   'attribute' => 'auth_key',
                   'label' => 'Chave de autenticação',
               ],
               //'verification_token',
               [
                   'attribute' => 'verification_token',
                   'label' => 'Token de verificação',
                   'contentOptions' => ['class' => 'truncate-user'],
               ],
               //'password_hash',
               //'password_reset_token',
               'email:email',
               //'status',
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
                   'contentOptions' => ['class' => 'truncate-user'],
               ],
           //   'created_at',
           // 'updated_at',
           ],
       ])
       ?>-->

    <div class="col-md-12 col-xs-12" style="text-align: center;">
        <br>
        <p>
            <?php
            if (empty($p) == FALSE)
                if (Yii::$app->user->identity->id != $model->id) {
                    echo Html::a('Alterar permisão', ['/authassignment/update', 'item_name' => $p[0]['item_name'], 'user_id' => $model->id], ['class' => 'btn btn-danger',]);
                }
            ?>
            <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Eliminar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem a certeza que pretende eliminar o utilizador?',
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
                [
                    'attribute' => 'user_id',
                    'label' => '',
                    'format' => 'raw',
                    'value' => function($data) {

                        $p = \app\models\Authassignment::find()->where(['user_id' => $data->id])->all();
                        if ($p != null)
                            return Html::a('<span>Alterar</span>', ['/authassignment/update', 'item_name' => $p[0]['item_name'], 'user_id' => $data->id], [
                                        'class' => 'btn btn-danger',]) . '<b>&nbsp;&nbsp;&nbsp;&nbsp;' . $p[0]['item_name'] . '</b>';
                        return '' . Html::a('<span>Alterar</span>', ['/authassignment/create', 'user_id' => $data->id], [
                                    'class' => 'btn btn-danger',]) . '<b>&nbsp;&nbsp;&nbsp;&nbsp;null</b>';
                    },
                ],
                /* [
                  'attribute' => 'auth_key',
                  'label' => 'Chave de autenticação',
                  'value' => 'auth_key',
                  'contentOptions' => ['class' => 'truncate-user'],
                  ],*
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
