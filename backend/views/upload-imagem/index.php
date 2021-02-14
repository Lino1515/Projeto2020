<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UploadImagemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Imagems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-imagem-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Upload Imagem', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'path',
            'nome',
            'id_user',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
