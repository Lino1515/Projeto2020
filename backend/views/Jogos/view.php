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
?>
<div class="jogos-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'Id',
            'Nome',
            'Descricao:ntext',
            'Data',
            [
                'attribute' => 'Trailer',
                'label' => 'Trailer_link',
                'value' => $model->Trailer,
            ],
            'Imagem',
            'tipojogo.Nome',
        ],
    ]);
    ?>

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
</div>
