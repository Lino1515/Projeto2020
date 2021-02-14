<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Authassignment */

$this->title = "CARROS";
$this->params['breadcrumbs'][] = ['label' => 'Authassignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="authassignment-view">

    <h1><?= Html::encode($this->title) ?></h1>

 <?php 
echo '<br><br><br> O numero de carros totais é de: '. $carrostoais;
 ?>
</div>
