<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest {

    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures() {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php'
            ]
        ];
    }

    public function checkLoginUserEmpty(FunctionalTester $I) {
        $I->amOnPage('/site/login');
        $I->fillField('Username', '');
        $I->fillField('Password', '');
        $I->click('login-button');
        //$I->see('Incorrect username or password');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    /**
     * @param FunctionalTester $I
     */
    public function checkLoginUserBadPassword(FunctionalTester $I) {
        $I->amOnPage('/site/login');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'dinas');
        $I->click('login-button');
        $I->see('Incorrect username or password');
    }

    public function checkLoginUserCorrect(FunctionalTester $I) {
        $I->amOnPage('/site/login');
        $I->fillField('Username', 'erau');
        $I->fillField('Password', 'password_0');
        $I->click('button[name="login-button"]');
        //$I->see('Incorrect username or password');

        $I->see('Utilizadores');
        $I->see('Rreports');
        $I->see('Rutilizador');
        $I->see('Logout (erau)');
        //$I->seeCurrentUrlEquals('/Projeto2020/backend/web/');
    }

}
