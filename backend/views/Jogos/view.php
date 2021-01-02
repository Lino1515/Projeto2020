<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Tipojogo;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$genero = Tipojogo::findOne($model->Id_tipojogo);
?>
<div class="jogos-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="grid-index-brackend col-md-12 col-xs-12" >

        <br>

        <div class="col-md-7 col-xs-12">
            <p class="descricao-index-brackend" style="text-align: justify;">
                <?= $model->Descricao ?>
            </p>
        </div>

        <div class="descricao-index-brackend col-md-5 col-xs-12"style="text-align: center;">
            <?= Html::img($model->Imagem, ['alt' => $model->Nome, 'class' => 'imagem-veiw-backend']); ?>
            <p>
                <b>Data de lançamento: </b><?= $model->Data; ?><br>
                <b>Género: </b><?= $genero->Nome; ?><br>
                <b>Link: </b><a href="https://www.youtube.com/watch?v="<?= $model->Trailer ?> target="_blank">Youtube</a><br>
            </p>
        </div>

        <br>

        <div class="col-md-12 col-xs-12" style="text-align: center;">
            <h1>Trailer</h1>
            <br>
        </div>

        <div class="col-md-12 col-xs-12" style="text-align: center;">
            <?=
            $video = \tuyakhov\youtube\EmbedWidget::widget([
                'code' => $model->Trailer,
                'playerParameters' => [
                    'controls' => 2
                ],
                'iframeOptions' => [
                    'width' => '600',
                    'height' => '450'
                ]
            ]);
            ?>
            <p>
                <?= Html::a('Atualizar', ['update', 'id' => $model->Id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('Eliminar', ['delete', 'id' => $model->Id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Tem a certeza que pretende eliminar o jogo?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>
        </div>

        <!--  < ?=
           DetailView::widget([
               'model' => $model,
               'attributes' => [
                   //'Id',
                   //'Nome',
                   //'Descricao:ntext',
                   'Data',
                   [
                       'attribute' => 'Trailer',
                       'label' => 'Trailer link',
                       'value' => 'www.youtube.com/watch?v=' . $model->Trailer,
                   ],
                   'Imagem',
                   'tipojogo.Nome',
               ],
           ]);
           ?>-->

    </div> 
</div> 