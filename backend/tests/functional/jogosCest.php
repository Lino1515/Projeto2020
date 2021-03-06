<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class jogosCest {

    public function _fixtures() {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function _before(FunctionalTester $I) {
        //$I->amOnPage('/jogos/index');
    }

    // tests
    /* public function tryToTest(FunctionalTester $I) {

      } */
    public function checkPage(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');


        $I->amOnPage('Projeto2020/backend/web/index.php?r=jogos%2Findex');

        $I->see('Jogos');
        $I->see('Procurar:');
    }

    public function checkCriarEmpty(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=jogos%2Fcreate');

        $I->submitForm('#criarform', []);

        $I->see('Nome cannot be blank.');
        $I->see('Descricao cannot be blank.');
        $I->see('Trailer cannot be blank.');
        $I->see('Data cannot be blank.');
        $I->see('Id Tipojogo cannot be blank');
    }

    public function checkCriarValido(FunctionalTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');
        
        $I->seeInCurrentUrl('index');

        $I->amOnPage('Projeto2020/backend/web/index.php?r=jogos%2Fcreate');

        $I->submitForm('#criarform', [
            'Jogos[Nome]' => 'TesteNome',
            'Jogos[Descricao]' => 'TesteDescrição',
            'Jogos[Trailer]' => 'TesteTrailer',
            'Jogos[Imagem]' => '',
            'Jogos[Data]' => '2021-01-01',
            'Jogos[Id_tipojogo]' => '1',
        ]);

        $I->seeRecord('\app\models\Jogos', array('Nome' => 'TesteNome'));
    }

}
