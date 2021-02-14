<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Authassignment */

$this->title = 'Authassignment';
$this->params['breadcrumbs'][] = ['label' => 'Authassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->item_name, 'url' => ['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="authassignment-update">

    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>

    <div class="grid-index-brackend col-md-12 col-xs-12">
        <?= $this->render('_form', ['model' => $model, 'user_id' => $user_id])
        ?>
    </div>

</div>
