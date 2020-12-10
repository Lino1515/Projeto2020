<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosreports */

$this->title = 'Create Comentariosreports';
$this->params['breadcrumbs'][] = ['label' => 'Comentariosreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosreports-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
