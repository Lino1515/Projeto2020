<?php

namespace backend\tests\acceptance;

use backend\tests\AcceptanceTester;
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

    public function checkLoginUserEmpty(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', '');
        $I->fillField('Password', '');
        $I->click('login-button');

        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    /**
     * @param AcceptanceTester $I
     */
    public function checkLoginUserBadPassword(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'dinas');
        $I->click('login-button');
        $I->see('Incorrect username or password');
    }

    public function checkLoginUserCorrect(AcceptanceTester $I) {
        $I->amOnPage('Projeto2020/backend/web/index.php?r=site%2Flogin');
        $I->fillField('Username', 'dinas');
        $I->fillField('Password', 'monca99per');
        $I->click('button[name="login-button"]');

        $I->see('Utilizadores');
        $I->see('Rreports');
        $I->see('Rutilizador');
        $I->see('Logout (dinas)');
    }

}
