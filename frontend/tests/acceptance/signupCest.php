<?php

class signupCest {
    /*  public function _before(AcceptanceTester $I) {

      }

      // tests
      public function tryToTest(AcceptanceTester $I) {

      } */

    public function frontpageSignup(AcceptanceTester $I) {
        $I->amOnPage('/Projeto2020/frontend/web/index.php?r=site%2Fsignup');
        $I->click('Signup');
        $I->submitForm('#form-signup', [
            'SignupForm[username]' => 'MilesDavis',
            'SignupForm[email]' => 'leopoldo31920@gmail.com',
            //'SignupForm[email]' => 'miles@davis.com',
            'SignupForm[password]' => 'querty123'
        ]);
    }

}
