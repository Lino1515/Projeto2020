<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Tipojogo;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Jogos */

$this->title = $model->Nome;
$this->params['breadcrumbs'][] = ['label' => 'Jogos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$genero = Tipojogo::findOne($model->Id_tipojogo);
?>
<div class="jogos-view">
    <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="grid-index-brackend col-md-12 col-xs-12" >

        <br>

        <div class="col-md-7 col-xs-12">
            <p class="descricao-index-brackend" style="text-align: justify;">
                <?= $model->Descricao ?>
            </p>
        </div>

        <div class="descricao-index-brackend col-md-5 col-xs-12"style="text-align: center;">
            <?= Html::img('../../backend/web/' . $model->Imagem, ['alt' => $model->Nome, 'class' => 'imagem-veiw-backend']); ?>
            <p>
                <b>Data de lançamento: </b><?= $model->Data; ?><br>
                <b>Género: </b><?= $genero->Nome; ?><br>
                <b>Link: </b><a href="https://www.youtube.com/watch?v="<?= $model->Trailer ?> target="_blank">Youtube</a><br>
            </p>
        </div>

        <br>

        <div class="col-md-12 col-xs-12" style="text-align: center;">
            <h1>Trailer</h1>
            <br>
        </div>

        <div class="col-md-12 col-xs-12" style="text-align: center;">
            <?=
            $video = \tuyakhov\youtube\EmbedWidget::widget([
                'code' => $model->Trailer,
                'playerParameters' => [
                    'controls' => 2
                ],
                'iframeOptions' => [
                    'width' => '600',
                    'height' => '450'
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <?php if (!(Yii::$app->user->isGuest)) { ?>
            <div class="grid-index-brackend col-md-6" style="width: 50%;">

                <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
                    <h3>Comentarios</h3>
                </div>
                <?php $form = ActiveForm::begin(['action' => ['comentarios/create'], 'options' => ['method' => 'post']]); ?>

                <?= $form->field($modelComent, 'Data')->hiddenInput(['value' => date('Y-m-d'), 'readonly' => true])->label('') ?>

                <div class="col-md-10" style="width: 70%">
                    <?= $form->field($modelComent, 'Descricao')->textarea(['rows' => 3, 'max-width' => '10px'])->label('') ?>
                </div>
                <?= $form->field($modelComent, 'Id_jogo')->hiddenInput(['value' => $model->Id, 'readonly' => true])->label('') ?>

                <?= $form->field($modelComent, 'Id_utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                <div class="form-group col-md-2" style="width: 10%">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'enviarform']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        <?php } ?>
        <!-- REVIEWS -->
        <?php if (!(Yii::$app->user->isGuest)) { ?>
            <div class="grid-index-brackend col-md-6" style="width: 50%;" >

                <div class="titulo-index-brackend col-md-10 col-xs-12" style="padding-left: 0px;">
                    <h3>Reviews</h3>
                </div>
                <?php $form = ActiveForm::begin(['action' => ['review/create'], 'options' => ['method' => 'post']]); ?>

                <?= $form->field($modelReview, 'Data')->hiddenInput(['value' => date('Y-m-d'), 'readonly' => true])->label('') ?>
                <div class="col-md-10" style="width: 70%">
                    <?= $form->field($modelReview, 'Descricao')->textarea(['rows' => 3])->label('') ?>
                </div>
                <div class="col-md-2" style="width: 20%">
                    <?= $form->field($modelReview, 'Score')->textInput(['type' => 'number', 'min' => "0", 'max' => "10", 'step' => '0.01'])->label('Score:') ?>
                </div>
                <?= $form->field($modelReview, 'Id_Jogo')->hiddenInput(['value' => $model->Id, 'readonly' => true])->label('') ?>

                <?php if (!(Yii::$app->user->isGuest)) { ?>
                    <?= $form->field($modelReview, 'Id_Utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>
                <?php } ?>

                <div class="form-group col-md-2" style="width: 10%">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'enviarform']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

        <?php } ?>

        <?php if (empty($coment) != true) { ?>
            <div class="grid-index-brackend col-md-6" style="width: 50%; float: left;" >

                <?php
                foreach ($coment as $comValor) {
                    $utilizadorcom = frontend\models\User::find()->where(['id' => $comValor->Id_utilizador])->one();
                    echo $utilizadorcom->username . '  ' . $comValor->Data . '<br>';
                    echo 'R:' . $comValor->Descricao . '<br>';
                    if (!(Yii::$app->user->isGuest)) {
                        if ($comValor->Id_utilizador == Yii::$app->user->identity->id) {

                            echo Html::a('Eliminar', ['/comentarios/delete', 'id' => $comValor->Id], [
                                'data' => [
                                    'confirm' => 'Tem a certeza que pretende eliminar este comentario?',
                                    'method' => 'post',
                                ],
                            ]) . '<br>';
                        }

                        $checklikereview = frontend\models\comentariosutilizador::find()->where(['Id_comentario' => $comValor->Id, 'Id_utilizador' => Yii::$app->user->identity->id])->one();
                        if ($checklikereview == false) {
                            ?>
                            <div style="display: none; visibility: hidden;"> 
                                <?php $form = ActiveForm::begin(['action' => ['comentariosutilizador/create'], 'options' => ['method' => 'post']]); ?>

                                <?= $form->field($modelComentUser, 'Id_comentario')->hiddenInput(['value' => $comValor->Id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelComentUser, 'Id_utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelComentUser, 'Like_Dislike')->hiddenInput(['value' => 1, 'readonly' => true])->label('') ?>

                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('like', ['class' => 'btn btn-success']) ?>
                            </div>

                            <div style="display: none; visibility: hidden;"> 
                                <?php ActiveForm::end(); ?>
                            </div>
                            <?php
                        }
                    }
                    echo '<br>';
                }
            }
            ?>
        </div>
        <?php if (empty($reviews) != true) { ?>
            <div class="grid-index-brackend col-md-6" style="width: 50%; float: right;" >

                <?php
                foreach ($reviews as $revValor) {

                    $utilizadorcom = frontend\models\User::find()->where(['id' => $revValor->Id_Utilizador])->one();

                    echo $utilizadorcom->username . '  ' . $revValor->Data . '<br>';
                    echo 'R:' . $revValor->Descricao . '<br>';
                    echo 'Score:' . $revValor->Score . '<br>';

                    if (!(Yii::$app->user->isGuest)) {
                        if ($revValor->Id_Utilizador == Yii::$app->user->identity->id) {

                            echo Html::a('Eliminar', ['/review/delete', 'id' => $revValor->Id], [
                                'data' => [
                                    'confirm' => 'Tem a certeza que pretende eliminar esta review?',
                                    'method' => 'post',
                                ],
                            ]);
                        }
                        $checklikereview = frontend\models\Reviewutilizador::find()->where(['Id_review' => $revValor->Id, 'Id_utilizador' => Yii::$app->user->identity->id])->one();
                        if ($checklikereview == false) {
                            ?>
                            <div style="display: none; visibility: hidden;"> 
                                <?php $form = ActiveForm::begin(['action' => ['reviewutilizador/create'], 'options' => ['method' => 'post']]); ?>

                                <?= $form->field($modelreviewUser, 'Id_review')->hiddenInput(['value' => $revValor->Id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelreviewUser, 'Id_Utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelreviewUser, 'Helpful_UnHelpful')->hiddenInput(['value' => 1, 'readonly' => true])->label('') ?>

                            </div>
                            <div class="form-group">
                                <?= Html::submitButton('like', ['class' => 'btn btn-success']) ?>
                            </div>

                            <div style="display: none; visibility: hidden;"> 
                                <?php ActiveForm::end(); ?>
                            </div>
                            <?php
                        }
                    }
                    echo '<br>';
                }
            }
            ?>
        </div>
    </div>
</div>