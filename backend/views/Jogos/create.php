<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */

$this->title = 'Criar Jogo';
$this->params['breadcrumbs'][] = ['label' => 'Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogos-create">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?= $this->render('_form', ['model' => $model, 'tipojogo' => $tipojogo,]) ?>
    </div>

</div>
