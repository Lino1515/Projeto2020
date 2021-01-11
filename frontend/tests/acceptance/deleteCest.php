<?php

class deleteCest {
    /*  public function _before(AcceptanceTester $I)
      {
      }

      // tests
      public function tryToTest(AcceptanceTester $I)
      {
      } */

    public function backPageDelete(AcceptanceTester $I) {
        $I->amOnPage('/Projeto2020/backend/web/index.php');
        $I->see('Login');
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'dinas',
            'LoginForm[password]' => 'monca99per'
        ]);
        $I->see('Congratulations!');
        //$I->click('button[name="login-button"]');
        $I->click('Utilizadores');
        $I->submitForm('#w0', [
            'UserSearch[username]' => 'MilesDavis'
        ]);
        $I->see('alterar');
        $I->click('span[class="glyphicon glyphicon-pencil btn btn-success"]');
        $I->submitForm('#w0', [
            'User[status]' => 0
        ]);
        $I->see('Update Authassignment:');
    }

}
