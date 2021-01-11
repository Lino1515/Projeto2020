<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'IGDb';
?>
<div class="site-index">


    <div class="row" style="background-color: white;">
        <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
            <h3>Jogos mais antigos:</h3>
        </div>
        <?php foreach ($jogosantig as $valor) { ?>
            <div class="col-lg-3 col-md-3 col-xs-6" style="margin: 5px; padding: 20px; border: 1px solid gray; border-radius: 5px; max-width: 280px;">
                <div class="card" style="width: 18rem;">
                    <?= Html::img('../../backend/web/' . $valor->Imagem, ['alt' => $valor->Nome, 'class' => 'card-img-top', 'width' => 200, 'height' => 150]); ?>
                    <div class="card-body">
                        <h5 class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b><?= $valor->Nome ?></b></h5>
                        <?=
                        Html::a('ver', ['/jogos/view', 'id' => $valor->Id], [
                            'class' => 'btn btn-danger',]);
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>




    <div class="row" style="background-color: white;">
        <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
            <h3>Jogos mais recentes:</h3>
        </div>
        <?php foreach ($jogosrecent as $valor) { ?>
            <div class="col-lg-3 col-md-3 col-xs-6" style="margin: 5px; padding: 20px; border: 1px solid gray; border-radius: 5px; max-width: 280px;">
                <div class="card" style="width: 18rem;">
                    <?= Html::img('../../backend/web/' . $valor->Imagem, ['alt' => $valor->Nome, 'class' => 'card-img-top', 'width' => 200, 'height' => 150]); ?>
                    <div class="card-body">
                        <h5 class="card-title" style="width: 250px;white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b><?= $valor->Nome ?></b></h5>
                        <?=
                        Html::a('ver', ['/jogos/view', 'id' => $valor->Id], [
                            'class' => 'btn btn-danger',]);
                        ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>
