<?php

namespace backend\tests\acceptance;

use backend\tests\AcceptanceTester;
use common\fixtures\UserFixture;

class comentariosCest {

    public function _fixtures() {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function checkPage(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');


        $I->see('Comentarios');
        $I->click('Comentarios');
        $I->see('Lista');
        $I->see('Criar');
        $I->see('» Lista');
        $I->click('» Lista');
    }

    public function checkCriarEmpty(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->see('Comentarios');
        $I->click('Comentarios');
        $I->see('» Criar comentarios');
        $I->see('» Lista comentarios');
        $I->click('» Lista comentarios');

        $I->see('Criar novo');
        $I->click('Criar novo');

        $I->see('Criar Comentários');
        $I->see('Descrição:');
        $I->see('Jogo:');

        $I->click('Guardar');
        $I->see('Descricao cannot be blank.');
        $I->see('Id Jogo cannot be blank.');
    }

    public function checkCriarValido(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->see('Comentarios');
        $I->click('Comentarios');
        $I->see('» Criar comentarios');
        $I->see('» Lista comentarios');
        $I->click('» Lista comentarios');

        $I->see('Criar novo');
        $I->click('Criar novo');

        $I->see('Criar Comentários');
        $I->see('Descrição:');
        $I->see('Jogo:');

        $I->submitForm('#enviarform', [
            'Comentarios[Descricao]' => 'TesteDescricao',
            'Comentarios[Id_jogo]]' => '1',
        ]);

        $I->seeRecord('\app\models\Comentarios', array('Id_jogo' => '1', 'Descricao' => 'TesteDescricao'));
    }

}
