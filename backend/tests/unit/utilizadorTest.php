<?php

namespace backend\tests;

use common\fixtures\UserFixture;
use app\models\User;

//use common\models\User;

class utilizadorTest extends \Codeception\Test\Unit {

    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before() {

        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
    }

    protected function _after() {
        
    }

    public function testValidationId() {
        $user = new User();

        $user->setAttribute('id', null);
        $this->assertTrue($user->validate(['id']));

        $user->setAttribute('id', '');
        $this->assertTrue($user->validate(['id']));

        $user->setAttribute('id', 'Este Item so aceita int.');
        $this->assertFalse($user->validate(['id']));

        $user->setAttribute('id', '99');
        $this->assertTrue($user->validate(['id']));
    }

    public function testValidationUsername() {
        $user = new User();

        $user->setAttribute('username', null);
        $this->assertFalse($user->validate(['username']));

        $user->setAttribute('username', '');
        $this->assertFalse($user->validate(['username']));

        $user->setAttribute('username', 'ESTE TESTE TEM MAIS DE 25 Chars???????????????????????????????????????????????');
        $this->assertFalse($user->validate(['username']));

        $user->setAttribute('username', 'UserTeste');
        $this->assertTrue($user->validate(['username']));
    }

    public function testValidationAuthkey() {
        $user = new User();

        $user->setAttribute('auth_key', null);
        $this->assertFalse($user->validate(['auth_key']));

        $user->setAttribute('auth_key', '');
        $this->assertFalse($user->validate(['auth_key']));

        $user->setAttribute('auth_key', 'ESTE TESTE TEM MAIS DE 32 Chars???????????????????????????????????????????????');
        $this->assertFalse($user->validate(['auth_key']));

        $user->setAttribute('auth_key', $user->generateAuthKey());
        $this->assertTrue($user->validate(['auth_key']));
    }

    ///////////$user->generateEmailVerificationToken();

    public function testValidationPassword_hash() {
        $user = new User();

        $user->setAttribute('password_hash', null);
        $this->assertFalse($user->validate(['password_hash']));

        $user->setAttribute('password_hash', '');
        $this->assertFalse($user->validate(['password_hash']));

        $user->setAttribute('password_hash', $user->setPassword('TesteDaPassword1'));
        $this->assertTrue($user->validate(['password_hash']));
    }

    public function testValidationResetPasswordToken() {
        //SENDO VARCHAR(255) ACEITA QUALQUER TIPO DE STRING POREM PARA COMPENSAR CRIAMOS O METODO GENERATE PASSWORD TOKEN
        $user = new User();

        $user->setAttribute('password_reset_token', 'Este campo tem varchar de 255 ');
        $this->assertTrue($user->validate(['password_reset_token']));

        $user->setAttribute('password_reset_token', null);
        $this->assertTrue($user->validate(['password_reset_token']));

        $user->setAttribute('password_reset_token', '');
        $this->assertTrue($user->validate(['password_reset_token']));

        $user->setAttribute('password_reset_token', $user->generatePasswordResetToken());
        $this->assertTrue($user->validate(['password_reset_token']));
    }

    public function testValidationEmail() {
        $user = new User();

        $user->setAttribute('email', null);
        $this->assertFalse($user->validate(['email']));

        $user->setAttribute('email', '');
        $this->assertFalse($user->validate(['email']));

        $user->setAttribute('email', 'Este campo é do tipo email');
        $this->assertFalse($user->validate(['email']));

        $user->setAttribute('email', 'teste@teste.com');
        $this->assertTrue($user->validate(['email']));
    }

    public function testValidationStatus() {
        //ESTE CAMPO PODE SER NULL NO FORM PORQUE VAI RECEBER O VALOR DEFAULT DE 9 (INATIVO)
        $user = new User();


        $user->setAttribute('status', 'Este campo só aceita valores int.');
        $this->assertFalse($user->validate(['status']));

        $user->setAttribute('status', null);
        $this->assertTrue($user->validate(['status']));

        $user->setAttribute('status', '');
        $this->assertTrue($user->validate(['status']));

        $user->setAttribute('status', '10');
        $this->assertTrue($user->validate(['status']));
    }

    public function testValidationVerificationToken() {
        //ESTE CAMPO PODE SER NULL NO FORM PORQUE VAI RECEBER O VALOR DEFAULT GERADO ALEATORIAMENTE 
        $user = new User();

        $user->setAttribute('verification_token', 'Este campo tem varchar de 255 ');
        $this->assertTrue($user->validate(['verification_token']));

        $user->setAttribute('verification_token', null);
        $this->assertTrue($user->validate(['verification_token']));

        $user->setAttribute('verification_token', '');
        $this->assertTrue($user->validate(['verification_token']));

        $user->setAttribute('verification_token', $user->generateEmailVerificationToken());
        $this->assertTrue($user->validate(['verification_token']));
    }

    public function testValidateSave() {

        $user = new User();

        $user->setAttribute('username', 'TesteUser');
        $user->setAttribute('auth_key', $user->generateAuthKey());
        $user->setAttribute('password_hash', $user->setPassword('monca99per'));
        $user->setAttribute('email', '2180707@my.ipleiria.pt');
        $user->setAttribute('verification_token', $user->generateEmailVerificationToken());
        $user->setAttribute('status', '10');
        $user->setAttribute('created_at', '1391885313');
        $user->setAttribute('updated_at', '1391885313');

        $user->save();
        $this->tester->seeInDatabase('User', ['email' => '2180707@my.ipleiria.pt']);
    }

    public function testBadValidateSave() {

        $user = new User();

        $user->setAttribute('username', 'test2.test');
        $user->setAttribute('auth_key', $user->generateAuthKey());
        $user->setAttribute('password_hash', $user->setPassword('monca99per'));
        $user->setAttribute('email', 'test2@mail.com');
        $user->setAttribute('verification_token', $user->generateEmailVerificationToken());
        $user->setAttribute('status', '10');
        $user->setAttribute('created_at', '1391885313');
        $user->setAttribute('updated_at', '1391885313');


        expect_not($user->save());

        expect_that($user->getErrors('username'));
        expect_that($user->getErrors('email'));

        expect($user->getFirstError('username'))
                ->equals('This username has already been taken.');
        expect($user->getFirstError('email'))
                ->equals('This email address has already been taken.');
    }

}
