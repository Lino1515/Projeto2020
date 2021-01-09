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
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->see('Tipo Jogo');
        $I->click('Tipo Jogo');
        $I->see('Lista');
        $I->see('Criar');
        $I->see('» Lista');
        $I->click('» Lista');
    }

    public function checkCriarEmpty(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->see('Tipo Jogo');
        $I->click('Tipo Jogo');
        $I->see('Lista');
        $I->see('Criar');
        $I->see('» Lista');
        $I->click('» Lista');

        $I->see('Tipo de jogos');
        $I->click('a[name="criartipojogo"]');
        $I->see('Criar tipo de jogo');
        $I->see('Nome:');
        $I->see('Descrição:');

        //$I->see('Criar', 'button');

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
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->see('Tipo Jogo');
        $I->click('Tipo Jogo');
        $I->see('Lista');
        $I->see('Criar');
        $I->see('» Lista');
        $I->click('» Lista');

        $I->see('Tipo de jogos');
        $I->click('a[name="criartipojogo"]');
        $I->see('Criar tipo de jogo');

        $I->submitForm('#enviarform', [
            'Tipojogo[Nome]' => 'TesteNome',
            'Tipojogo[Descricao]' => 'TesteDescrição',
        ]);

        /* $I->see('TesteNome');
          $I->see('Atualizar');
          $I->see('Eliminar'); */

        $I->seeRecord('\app\models\Tipojogo', array('Nome' => 'TesteNome'));
    }

}
