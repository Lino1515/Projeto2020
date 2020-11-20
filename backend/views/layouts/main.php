<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style="overflow:auto;">
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'IGDb',
                'brandUrl' => Yii::$app->homeUrl,
                'innerContainerOptions' => ['class' => 'container-fluid'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top ',
                ],
            ]);
            $menuItemsNav = [['label' => 'Home', 'url' => ['/site/index']]];
            if (Yii::$app->user->isGuest) {
                $menuItemsNav[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {

                $menuItemsNav[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItemsNav,
            ]);
            NavBar::end();
            ?>

            <div class="container-fluid" style="padding-left: 0px; overflow: hidden; ">
                <div class="sidebarmain">
                    <?php
                    echo SideNav::widget([
                        //'type' => SideNav::TYPE_DEFAULT,
                        //'heading' => 'Options',
                        'options' => ['class' => 'sidebarstyle', 'style' => ''],
                        'items' => [
                            [
                                'label' => 'Tipo Jogo',
                                'items' => [
                                    ['label' => 'Lista', 'icon' => 'info-sign', 'url' => ['/tipojogo/index']],
                                    ['label' => 'Criar', 'icon' => 'phone',  'url' => ['/tipojogo/create']],
                                ],
                                'url' => ['/tipojogo/index'],
                            ],
                            [
                                'label' => 'Jogos',
                                'url' => ['/jogos/index']
                            ],
                            [
                                'label' => 'User',
                                'url' => ['/user/index']
                            ],
                            [
                                'label' => 'Comentarios',
                                'url' => ['/comentarios/index']],
                            [
                                'label' => 'Review',
                                'url' => ['/review/index']
                            ],
                            [
                                'label' => 'Creports',
                                'url' => ['/comentariosreports/index']
                            ],
                            [
                                'label' => 'Cutilizador',
                                'url' => ['/comentariosutilizador/index']
                            ],
                            [
                                'label' => 'Rutilizador',
                                'url' => ['/reviewutilizador/index']
                            ],
                            [
                                'label' => 'Rreports',
                                'url' => ['/reviewreports/index']
                            ],
                        ],
                    ]);
                    ?>
                </div>
                <div class="content_text">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                    <?= Alert::widget() ?>
                    <?= $content ?>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
