<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class reviewsCest {
    /* public function _before(FunctionalTester $I) {

      }

      // tests
      public function tryToTest(FunctionalTester $I) {

      } */

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
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=review%2Findex');
        $I->see('Reviews');
    }

    public function checkCriarEmpty(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=review%2Fcreate');
        $I->see('Criar Review');

        $I->submitForm('#enviarform', [
            'Review[Data]' => '',
            'Review[Descricao]' => '',
            'Review[Score]' => '',
            'Review[Id_Jogo]' => '',
        ]);

        $I->see('Descricao cannot be blank.');
        $I->see('Score cannot be blank.');
        $I->see('Id Jogo cannot be blank.');
    }

    public function checkCriarValido(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=review%2Fcreate');
        $I->see('Criar Review');

        $I->submitForm('#enviarform', [
            'Review[Descricao]' => 'TesteDescricao',
            'Review[Score]' => '10',
            'Review[Id_Jogo]' => '1',
        ]);

        $I->seeRecord('\app\models\Review', array('Id_jogo' => '1', 'Descricao' => 'TesteDescricao'));
    }

    public function checkCriarBadScore(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=review%2Fcreate');
        $I->see('Criar Review');

        $I->submitForm('#enviarform', [
            'Review[Descricao]' => 'TesteDescricao',
            'Review[Score]' => 'TesteNoScore',
            'Review[Id_Jogo]' => '1',
        ]);
        $I->see('Score must be a number.');
    }

}
