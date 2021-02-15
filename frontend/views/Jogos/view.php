<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Tipojogo;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

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
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success', 'id' => 'enviarform', 'style' => 'margin-top: -10px; margin-left: 5px;']) ?>
                </div>
                <?= $form->field($modelReview, 'Id_Jogo')->hiddenInput(['value' => $model->Id, 'readonly' => true])->label('') ?>

                <?php if (!(Yii::$app->user->isGuest)) { ?>
                    <?= $form->field($modelReview, 'Id_Utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>
                <?php } ?>
                <?php ActiveForm::end(); ?>
            </div>

        <?php } ?>

        <?php if (empty($coment) != true) { ?>
            <div class="grid-index-brackend col-md-6" style="width: 50%; float: left;" >

                <?php
                foreach ($coment as $comValor) {
                    $utilizadorcom = frontend\models\User::find()->where(['id' => $comValor->Id_utilizador])->one();
                    echo '<b>' . $utilizadorcom->username . '  ' . $comValor->Data . '</b><br>';
                    echo '<b>R:</b>' . $comValor->Descricao . '<br>';
                    ?>
                    <div style="float: right;">
                        <?php
                        if (!(Yii::$app->user->isGuest)) {
                            if ($comValor->Id_utilizador == Yii::$app->user->identity->id) {

                                echo Html::a('Eliminar', ['/comentarios/delete', 'id' => $comValor->Id], [
                                    'data' => [
                                        'confirm' => 'Tem a certeza que pretende eliminar este comentario?',
                                        'method' => 'post',
                                    ]
                                ]);
                            }
                            $reportComentURL = Url::toRoute(['/comentariosreports/index']);
                            //$reportComentURL = Url::toRoute(['/comentariosreports/create', 'id' => $valor->Id];
                            //echo '<a style="margin-left:10px;" onclick="reportcoment(' . $reportComentURL . ')data-toggle="modal" data-target="#myModal""> Report </a>';
                            echo '<a style="margin-left:10px;" onclick="reportcoment(' . $comValor->Id . ')"> Report </a>';
                            $countLikes = frontend\models\comentariosutilizador::find()->where(['Id_comentario' => $comValor->Id])->all();
                            echo ' <a style="margin-left:10px;" onclick="likecoment()"> Like </a>' . count($countLikes);
                            ?>
                        </div>
                        <?php
                        $checklikereview = frontend\models\comentariosutilizador::find()->where(['Id_comentario' => $comValor->Id, 'Id_utilizador' => Yii::$app->user->identity->id])->one();
                        if ($checklikereview == false) {
                            ?>
                            <div style="display: none; visibility: hidden;">
                                <?php $form = ActiveForm::begin(['action' => ['comentariosutilizador/create'], 'options' => ['method' => 'post'], 'id' => 'likecomentarios']); ?>

                                <?= $form->field($modelComentUser, 'Id_comentario')->hiddenInput(['value' => $comValor->Id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelComentUser, 'Id_utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelComentUser, 'Like_Dislike')->hiddenInput(['value' => 1, 'readonly' => true])->label('') ?>

                                <?= Html::submitButton('like', ['class' => 'btn btn-success']) ?>
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

                    echo '<b>' . $utilizadorcom->username . '  ' . $revValor->Data . '</b><br>';
                    echo '<b>Score:</b>' . $revValor->Score . '<br>';
                    echo '<b>R:</b>' . $revValor->Descricao . '<br>';
                    ?>
                    <div style="float: right;">
                        <?php
                        if (!(Yii::$app->user->isGuest)) {
                            if ($revValor->Id_Utilizador == Yii::$app->user->identity->id) {

                                echo Html::a('Eliminar', ['/review/delete', 'id' => $revValor->Id], [
                                    'data' => [
                                        'confirm' => 'Tem a certeza que pretende eliminar esta review?',
                                        'method' => 'post',
                                    ],
                                ]);
                            }
                            echo '<a style="margin-left:10px;" onclick="reportreview(' . $revValor->Id . ')"> Report </a>';
                            $countLikes = frontend\models\Reviewutilizador::find()->where(['Id_review' => $revValor->Id])->all();
                            echo ' <a style="margin-left:10px;" onclick="likereviews()"> Like </a>' . count($countLikes);
                            ?>
                        </div>
                        <?php
                        $checklikereview = frontend\models\Reviewutilizador::find()->where(['Id_review' => $revValor->Id, 'Id_utilizador' => Yii::$app->user->identity->id])->one();
                        if ($checklikereview == false) {
                            ?>
                            <div style="display: none; visibility: hidden;"> 
                                <?php $form = ActiveForm::begin(['action' => ['reviewutilizador/create'], 'options' => ['method' => 'post'], 'id' => 'likereviews']); ?>

                                <?= $form->field($modelreviewUser, 'Id_review')->hiddenInput(['value' => $revValor->Id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelreviewUser, 'Id_Utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                                <?= $form->field($modelreviewUser, 'Helpful_UnHelpful')->hiddenInput(['value' => 1, 'readonly' => true])->label('') ?>

                                <?= Html::submitButton('like', ['class' => 'btn btn-success']) ?>
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
    <!-- Modal COMENTARIOS-->
    <div class="modal fade" id="reportcoment" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report do comentário</h4>
                </div>
                <div class="modal-body">

                    <div style="display: none; visibility: hidden;"> 
                        <?php $form = ActiveForm::begin(['action' => ['comentariosreports/create'], 'options' => ['method' => 'post'], 'id' => 'reportcomentario']); ?>

                        <?= $form->field($modeloComentaroiosReports, 'Id_comentario')->hiddenInput(['value' => '', 'readonly' => true, 'id' => 'formidcoment'])->label('') ?>

                        <?= $form->field($modeloComentaroiosReports, 'Id_utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                        <?= $form->field($modeloComentaroiosReports, 'Data')->hiddenInput(['value' => date("Y/m/d"), 'readonly' => true])->label('') ?>
                    </div>
                    <?= $form->field($modeloComentaroiosReports, 'Descricao')->textarea(['value' => '', 'rows' => 6])->label('Descrição:') ?>

                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal REVIEW-->
    <div class="modal fade" id="reportreview" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Report do review</h4>
                </div>
                <div class="modal-body">

                    <div style="display: none; visibility: hidden;"> 
                        <?php $form = ActiveForm::begin(['action' => ['reviewreports/create'], 'options' => ['method' => 'post'], 'id' => 'reportcomentario']); ?>

                        <?= $form->field($modeloReviewReports, 'Id_review')->hiddenInput(['value' => '', 'readonly' => true, 'id' => 'formidreview'])->label('') ?>

                        <?= $form->field($modeloReviewReports, 'Id_utilizador')->hiddenInput(['value' => Yii::$app->user->identity->id, 'readonly' => true])->label('') ?>

                        <?= $form->field($modeloReviewReports, 'Data')->hiddenInput(['value' => date("Y/m/d"), 'readonly' => true])->label('') ?>
                    </div>
                    <?= $form->field($modeloReviewReports, 'Descricao')->textarea(['value' => '', 'rows' => 6])->label('Descrição:') ?>

                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-success']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function likecoment() {
            document.forms["likecomentarios"].submit();
        }
        function likereviews() {
            document.forms["likereviews"].submit();
        }
        function reportcoment($res) {
            //data-toggle="modal" data-target="#reportcoment" 
            $res
            $('#formidcoment').val($res);
            $('#reportcoment').modal('show');
        }
        function reportreview($res) {
            //data-toggle="modal" data-target="#reportcoment" 
            $res
            $('#formidreview').val($res);
            $('#reportreview').modal('show');
        }
    </script>
</div>