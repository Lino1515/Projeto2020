<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ComentariosreportsSearch */

$this->title = 'Update Comentariosreports Search: ' . $model->Id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentariosreports Searches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_comentario, 'url' => ['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comentariosreports-search-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
