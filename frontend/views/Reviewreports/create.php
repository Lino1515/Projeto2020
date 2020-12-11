<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reviewreports */

$this->title = 'Create Reviewreports';
$this->params['breadcrumbs'][] = ['label' => 'Reviewreports', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewreports-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
