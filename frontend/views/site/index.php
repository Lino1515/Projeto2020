<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'IGDb';
?>
<div class="site-index">


    <div class="row">
        <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
            <h3>Jogos mais antigos:</h3>
        </div>
        <?php foreach ($jogosantig as $valor) { ?>
            <div onclick="irjogoindividual('<?= Url::toRoute(['/jogos/view', 'id' => $valor->Id]) ?>')" class="col-lg-4 col-md-4 col-xs-6" style="margin: 5px; padding: 20px; border: 1px solid gray; border-radius: 5px; max-width: 280px; background-color: white;">
                <div class="card" style="width: 18rem;">
                    <?= Html::img('../../backend/web/' . $valor->Imagem, ['alt' => $valor->Nome, 'class' => 'card-img-top', 'width' => 200, 'height' => 150]); ?>
                    <div class="card-body">
                        <h5 class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b><?= $valor->Nome ?></b></h5>
                        <p class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $resultado = frontend\models\Tipojogo::find()->where(['Id' => $valor->Id_tipojogo])->all();
                            //$valor->Nome
                            echo $resultado[0]->Nome;
                            ?>
                        </p>  
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>




    <div class="row">
        <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
            <h3>Jogos mais recentes:</h3>
        </div>
        <?php foreach ($jogosrecent as $valor) { ?>
            <div onclick="irjogoindividual('<?= Url::toRoute(['/jogos/view', 'id' => $valor->Id]) ?>')" class="col-lg-4 col-md-4 col-xs-6" style="margin: 5px; padding: 20px; border: 1px solid gray; border-radius: 5px; max-width: 280px; background-color: white;">
                <div class="card" style="width: 18rem;">
                    <?= Html::img('../../backend/web/' . $valor->Imagem, ['alt' => $valor->Nome, 'class' => 'card-img-top', 'width' => 200, 'height' => 150]); ?>
                    <div class="card-body">
                        <h5 class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b><?= $valor->Nome ?></b></h5>
                        <p class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            <?php
                            $resultado = frontend\models\Tipojogo::find()->where(['Id' => $valor->Id_tipojogo])->all();
                            //$valor->Nome
                            echo $resultado[0]->Nome;
                            ?>
                        </p>  
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
        function irjogoindividual($res) {
            window.location.href = $res;
        }
    </script>
</div>
