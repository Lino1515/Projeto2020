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


        $I->see('Comentarios');
        $I->click('Comentarios');
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

        $I->see('Comentarios');
        $I->click('Comentarios');
        $I->see('» Criar comentarios');
        $I->see('» Lista comentarios');
        $I->click('» Lista comentarios');

        $I->see('Criar novo');
        $I->click('Criar novo');
        //$I->click('a[name="criarnovocomentarios"]');
        $I->see('Criar Comentários');
        $I->see('Descrição:');
        $I->see('Jogo:');

        //$I->see('Criar', 'button');

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
        //$I->see('Incorrect username or password');
        $I->seeInCurrentUrl('index');

        $I->see('Comentarios');
        $I->click('Comentarios');
        $I->see('» Criar comentarios');
        $I->see('» Lista comentarios');
        $I->click('» Lista comentarios');

        $I->see('Criar novo');
        $I->click('Criar novo');
        //$I->click('a[name="criarnovocomentarios"]');
        $I->see('Criar Comentários');
        $I->see('Descrição:');
        $I->see('Jogo:');

        $I->submitForm('#enviarform', [
            'Comentarios[Descricao]' => 'TesteDescricao',
            'Comentarios[Id_jogo]]' => '1',
        ]);

        /* $I->see('TesteNome');
          $I->see('Atualizar');
          $I->see('Eliminar'); */

        $I->seeRecord('\app\models\Comentarios', array('Id_jogo' => '1', 'Descricao' => 'TesteDescricao'));
    }

}
