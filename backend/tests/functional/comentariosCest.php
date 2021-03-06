<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class comentariosCest {
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

        $I->amOnPage('Projeto2020/backend/web/index.php?r=comentarios%2Findex');

        $I->see('Comentários');
    }

    public function checkCriarEmpty(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=comentarios%2Fcreate');

        $I->see('Criar Comentários');

        $I->click('Guardar');
        $I->see('Descricao cannot be blank.');
        $I->see('Id Jogo cannot be blank.');
    }

    public function checkCriarValido(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=comentarios%2Fcreate');

        $I->see('Criar Comentários');

        $I->submitForm('#enviarform', [
            'Comentarios[Descricao]' => 'TesteDescricao',
            'Comentarios[Id_jogo]]' => '1',
        ]);

        $I->seeRecord('\app\models\Comentarios', array('Id_jogo' => '1', 'Descricao' => 'TesteDescricao'));
    }

}
