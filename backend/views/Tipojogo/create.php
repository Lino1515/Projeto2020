<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tipojogo */

$this->title = 'Create Tipojogo';
$this->params['breadcrumbs'][] = ['label' => 'Tipojogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipojogo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
