<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class TipojogoCest {

    public function _fixtures() {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    /* public function _before(FunctionalTester $I)
      {
      }

      // tests
      public function tryToTest(FunctionalTester $I)
      {
      } */

    public function checkPage(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=tipojogo%2Findex');
        $I->see('Tipo de jogos');
    }

    public function checkCriarEmpty(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=tipojogo%2Fcreate');

        $I->see('Criar tipo de jogo');
        $I->see('Nome:');
        $I->see('Descrição:');

        $I->click('Guardar');
        $I->see('Nome cannot be blank.');
        $I->see('Descricao cannot be blank.');
    }

    public function checkCriarValido(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=tipojogo%2Fcreate');

        $I->submitForm('#enviarform', [
            'Tipojogo[Nome]' => 'TesteNome',
            'Tipojogo[Descricao]' => 'TesteDescrição',
        ]);

        $I->seeRecord('\app\models\Tipojogo', array('Nome' => 'TesteNome'));
    }

}
