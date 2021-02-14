<?php

use yii\bootstrap\Html;

/* @var $this yii\web\View */

$this->title = 'IGDb';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Bem vindo <?= Yii::$app->user->identity->username ?>!</h1>

        <p class="lead">Esta aplicação está pronta para ser utilizada, vamos começar?</p>

    </div>

    <div class="body-content">

        <h3><b>O que pode ser feito?</b></h3>
        <br>
        <p>
            Aqui poderá gerir o conteúdo do seu website tornando-o único ao seu próprio gosto.
        </p>
        <p>
            Para facilitar o seu início criamos uma mini tutorial para o ajudar. 
        </p>
        <br>

        <div class="row">
            <div class="col-lg-6">
                <h3>Tipo de jogo</h3>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
                <?= Html::a('Tipo de jogo', ['/tipojogo/index'], ['class' => 'btn btn-default grid-button']) ?>
            </div>
            <div class="col-lg-6">
                <h2>Jogos</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <?= Html::a('Jogos', ['/jogos/index'], ['class' => 'btn btn-default grid-button']) ?>
            </div>
            <div class="col-lg-6">
                <h2>Comentários</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <?= Html::a('Comentários', ['/comentarios/index'], ['class' => 'btn btn-default grid-button']) ?>
            </div>
            <div class="col-lg-6">
                <h2>Reviews</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <?= Html::a('Reviews', ['/review/index'], ['class' => 'btn btn-default grid-button']) ?>
            </div>
        </div>

    </div>
</div>
