<?php

namespace backend\tests\acceptance;

use backend\tests\AcceptanceTester;
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

    public function _before(AcceptanceTester $I) {
        
    }

    public function checkPage(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->see('Jogos');
        $I->click('Jogos');
        $I->see('Lista');
        $I->see('Criar');
    }

    public function checkCriarEmpty(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->see('Jogos');
        $I->click('Jogos');
        $I->see('» Lista jogos');
        $I->click('» Lista jogos');

        $I->see('Criar Jogo');
        $I->click('a[name="criarjogo"]');
        $I->see('Nome:');
        $I->see('Descrição:');
        $I->see('Código do trailer:');
        $I->see('Upload da imagem:');
        $I->see('Data de lançamento:');
        $I->see('Tipo de jogo:');

        $I->submitForm('#criarform', []);

        $I->see('Nome cannot be blank.');
        $I->see('Descricao cannot be blank.');
        $I->see('Trailer cannot be blank.');
        $I->see('Data cannot be blank.');
        $I->see('Id Tipojogo cannot be blank');
    }

    public function checkCriarValido(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

        $I->seeInCurrentUrl('index');

        $I->see('Jogos');
        $I->click('Jogos');
        $I->see('» Lista jogos');
        $I->click('» Lista jogos');

        $I->see('Criar Jogo');
        $I->click('a[name="criarjogo"]');
        $I->see('Nome:');
        $I->see('Descrição:');
        $I->see('Código do trailer:');
        $I->see('Upload da imagem:');
        $I->see('Data de lançamento:');
        $I->see('Tipo de jogo:');

        $I->submitForm('#criarform', [
            'Jogos[Nome]' => 'TesteNome',
            'Jogos[Descricao]' => 'TesteDescrição',
            'Jogos[Trailer]' => 'TesteTrailer',
            'Jogos[Imagem]' => '',
            'Jogos[Data]' => '2021-01-01',
            'Jogos[Id_tipojogo]' => '1',
        ]);

        $I->see('TesteNome');
        $I->see('TesteDescrição');
    }

}
