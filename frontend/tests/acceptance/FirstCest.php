<?php

namespace frontend\tests\acceptance;

class FirstCest {

    public function frontpageWorks(AcceptanceTester $I) {
        $I->amOnPage('/Projeto2020/frontend/web/index.php?r=site%2Findex');
        $I->see('Home');
    }

   /* public function frontpageSignup(AcceptanceTester $I) {
        $I->amOnPage('/Projeto2020/frontend/web/index.php?r=site%2Fsignup');
        $I->click('Signup');
        $I->submitForm('#form-signup', [
            'SignupForm[username]' => 'MilesDavis',
            'SignupForm[email]' => 'miles@davis.com',
            'SignupForm[password]' => 'querty123'
        ]);
    }*/

    public function frontpageLogin(AcceptanceTester $I) {
        $I->amOnPage('/Projeto2020/frontend/web/index.php?r=site%2Flogin');
        $I->fillField('LoginForm[username]', 'dinas');
        $I->fillField('LoginForm[password]', 'monca99per');
        $I->click('button[name="login-button"]');
        $I->see('Logout');
        //$I->amOnPage('/Projeto2020/frontend/web/index.php');
        //$I->see('Login');
        $I->click('button[name="logout-btn"]');
        $I->see('Login');
    }

    /* public function _before(AcceptanceTester $I) {

      }

      // tests
      public function tryToTest(AcceptanceTester $I) {

      }
     */
}
