<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                ['username', 'trim'],
                ['username', 'required'],
                ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
                ['username', 'string', 'min' => 2, 'max' => 255],
                ['email', 'trim'],
                ['email', 'required'],
                ['email', 'email'],
                ['email', 'string', 'max' => 255],
                ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
                ['password', 'required'],
                ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup() {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user) {
        $user = User::findOne([
                    'email' => $this->email,
                    'status' => User::STATUS_INACTIVE
        ]);

        if ($user === null) {
            return false;
        }
        return Yii::$app
                        ->mailer
                        ->compose(
                                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user]
                        )
                        ->setFrom("igdb.games@gmail.com")
                        ->setTo($this->email)
                        ->setSubject('Account registration at ' . Yii::$app->name)
                        ->send();
        /* $teste = Yii::$app->mailer->compose(['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user])
          ->setFrom('leopoldo31920@gmail.com')
          ->setTo('leopoldo31920@gmail.com')
          //->setTo($this->email)
          ->setSubject('Account registration at ' . Yii::$app->name)
          ->setTextBody('Plain text content')
          ->setHtmlBody('<b>HTML content</b>')
          ->send(); */
        /* $teste2 = Yii::$app->mailer->compose(['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user])
          ->setFrom('leopoldo31920@gmail.com')
          ->setTo('leopoldo31920@gmail.com')
          ->setSubject('Account registration at ' . Yii::$app->name)
          ->send(); */
        return Yii::$app->mailer->compose(['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user])
                        ->setFrom('igdb.games@gmail.com')
                        //->setTo('leopoldo31920@gmail.com')
                        ->setTo($this->email)
                        ->setSubject('Account registration at ' . 'IGDb')
                        ->setTextBody('Plain text content')
                        ->setHtmlBody('<b>Ativação da sua conta:</b><br><p>Codigo:<br><b>' . $user->verification_token . '</b></p>')
                        ->send();
        /* return Yii::$app->mailer->compose(['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user])
          ->setFrom('leopoldo31920@gmail.com')
          ->setTo($this->email)
          ->setSubject('Account registration at ' . 'IGDb')
          ->send(); */
    }

}
