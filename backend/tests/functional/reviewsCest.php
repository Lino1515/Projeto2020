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

        $I->see('Review');
        $I->click('Review');
        $I->see('» Criar reviews');
        $I->see('» Lista reviews');
        $I->click('» Lista reviews');
    }

    public function checkCriarEmpty(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->see('Review');
        $I->click('Review');
        $I->see('» Criar reviews');
        $I->see('» Lista reviews');
        $I->click('» Lista reviews');

        $I->see('Criar Novo');
        $I->click('Criar Novo');
        //$I->click('a[name="criarnovocomentarios"]');
        $I->see('Criar Review');
        $I->see('Descrição:');
        $I->see('Jogo:');
        $I->see('Score:');

        //$I->see('Criar', 'button');
        $I->submitForm('#enviarform', [
            'Review[Data]' => '',
            'Review[Descricao]' => '',
            'Review[Score]' => '',
            'Review[Id_Jogo]' => '',
        ]);
        //$I->click('#enviarform');
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

        $I->see('Review');
        $I->click('Review');
        $I->see('» Criar reviews');
        $I->see('» Lista reviews');
        $I->click('» Lista reviews');

        $I->see('Criar Novo');
        $I->click('Criar Novo');
        //$I->click('a[name="criarnovocomentarios"]');
        $I->see('Criar Review');
        $I->see('Descrição:');
        $I->see('Jogo:');
        $I->see('Score:');

        //$I->see('Criar', 'button');
        $I->submitForm('#enviarform', [
            'Review[Descricao]' => 'TesteDescricao',
            'Review[Score]' => '10',
            'Review[Id_Jogo]' => '1',
        ]);
        //$I->click('#enviarform');

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

        $I->see('Review');
        $I->click('Review');
        $I->see('» Criar reviews');
        $I->see('» Lista reviews');
        $I->click('» Lista reviews');

        $I->see('Criar Novo');
        $I->click('Criar Novo');
        //$I->click('a[name="criarnovocomentarios"]');
        $I->see('Criar Review');
        $I->see('Descrição:');
        $I->see('Jogo:');
        $I->see('Score:');

        //$I->see('Criar', 'button');
        $I->submitForm('#enviarform', [
            'Review[Descricao]' => 'TesteDescricao',
            'Review[Score]' => 'TesteNoScore',
            'Review[Id_Jogo]' => '1',
        ]);
        $I->see('Score must be a number.');
    }

}
