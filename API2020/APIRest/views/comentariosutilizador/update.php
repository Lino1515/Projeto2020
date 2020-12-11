<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosutilizador */

$this->title = 'Update Comentariosutilizador: ' . $model->Id_comentario;
$this->params['breadcrumbs'][] = ['label' => 'Comentariosutilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id_comentario, 'url' => ['view', 'Id_comentario' => $model->Id_comentario, 'Id_utilizador' => $model->Id_utilizador]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comentariosutilizador-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
