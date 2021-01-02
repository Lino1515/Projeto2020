<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosreports */

$this->title = 'Criar reporte do comentário';
$this->params['breadcrumbs'][] = ['label' => 'Comentariosreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosreports-create">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>

</div>
