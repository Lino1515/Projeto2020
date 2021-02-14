<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UploadImagem */

$this->title = 'Create Upload Imagem';
$this->params['breadcrumbs'][] = ['label' => 'Upload Imagems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-imagem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
