<?php

namespace backend\tests\acceptance;

use backend\tests\AcceptanceTester;
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

    public function checkPage(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->see('Tipo Jogo');
        $I->click('Tipo Jogo');
        $I->see('Lista');
        $I->see('Criar');
        $I->see('» Lista');
        $I->click('» Lista');
    }

    public function checkCriarEmpty(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

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

        $I->click('Guardar');
        $I->see('Nome cannot be blank.');
        $I->see('Descricao cannot be blank.');
    }

    public function checkCriarValido(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->see('Please fill out the following fields to login:');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

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

        $I->see('TesteNome');
        $I->see('TesteDescrição');
    }

}
