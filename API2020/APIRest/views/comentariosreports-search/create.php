<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComentariosreportsSearch */

$this->title = 'Create Comentariosreports Search';
$this->params['breadcrumbs'][] = ['label' => 'Comentariosreports Searches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosreports-search-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
