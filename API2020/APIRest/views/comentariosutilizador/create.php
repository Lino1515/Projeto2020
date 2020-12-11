<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentariosutilizador */

$this->title = 'Create Comentariosutilizador';
$this->params['breadcrumbs'][] = ['label' => 'Comentariosutilizadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comentariosutilizador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
