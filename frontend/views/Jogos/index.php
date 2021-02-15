<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JogosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jogos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jogos-index">
    <div class="row">
        <br>
        <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;margin: 5px;">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <br>
        <div class="search-index-brackend col-md-12 col-xs-12" style="margin: 5px;">
            <?php
            echo $this->render('_search', ['model' => $searchModel]);
            foreach ($todosTipojogos as $link) {
                ?>

                <a onclick="procurar('<?= $link->Nome ?>')"><?= $link->Nome ?></a> // 
            <?php } ?>
        </div>
        <?php foreach ($dataProvider->models as $valor) { ?>
            <div onclick="irjogoindividual('<?= Url::toRoute(['/jogos/view', 'id' => $valor->Id]) ?>')" class="col-lg-4 col-md-4 col-xs-6" style="margin: 5px; padding: 20px; border: 1px solid gray; border-radius: 5px; max-width: 280px; background-color: white;">
                <div class="card" style="width: 18rem;">
                    <?= Html::img('../../backend/web/' . $valor->Imagem, ['alt' => $valor->Nome, 'class' => 'card-img-top', 'width' => 200, 'height' => 150]); ?>
                    <div class="card-body">
                        <h5 class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b><?= $valor->Nome ?></b></h5>
                        <p class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $resultado = frontend\models\Tipojogo::find()->where(['Id' => $valor->Id_tipojogo])->all();
                            echo $resultado[0]->Nome;
                            ?>
                        </p>  
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        function procurar($res) {
            document.getElementById("jogossearch-nome").value = $res;
            document.forms["w0"].submit();
        }
        function irjogoindividual($res) {
            window.location.href = $res;
        }
    </script>
</div>
