<?php

namespace backend\tests;

use common\fixtures\UserFixture;
use app\models\Review;

class reviewsTest extends \Codeception\Test\Unit {

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

    // tests
    public function testSomeFeature() {
        
    }

    public function testValidationId() {
        $review = new Review();

        $review->setAttribute('Id', null);
        $this->assertFalse($review->validate(['Descricao']));

        $review->setAttribute('Id', 'Este Item so aceita int.');
        $this->assertFalse($review->validate(['Id']));

        $review->setAttribute('Id', '1');
        $this->assertTrue($review->validate(['Id']));
    }

    public function testValidationDescricao() {
        $review = new Review();

        $review->setAttribute('Descricao', null);
        $this->assertFalse($review->validate(['Descricao']));

        $review->setAttribute('Descricao', '');
        $this->assertFalse($review->validate(['Descricao']));

        $review->setAttribute('Descricao', 'Aqui podemos escrever o quanto quisermos nao tem limite na base de dados, porem temos que realizar testes na mesma para ver se esta tudo bem.');
        $this->assertTrue($review->validate(['Descricao']));
    }

    public function testValidationData() {
        $review = new Review();

        $review->setAttribute('Data', null);
        $this->assertFalse($review->validate(['Data']));

        $review->setAttribute('Data', 'Este Item so aceita int.');
        $this->assertFalse($review->validate(['Data']));

        $review->setAttribute('Data', date("Y-m-d"));
        $this->assertTrue($review->validate(['Data']));
    }

    public function testValidationScore() {
        $review = new Review();

        $review->setAttribute('Score', null);
        $this->assertFalse($review->validate(['Score']));

        $review->setAttribute('Score', '');
        $this->assertFalse($review->validate(['Score']));

        $review->setAttribute('Score', 'escrever algum texto aqui');
        $this->assertFalse($review->validate(['Score']));

        $review->setAttribute('Score', '8,9');
        $this->assertFalse($review->validate(['Score']));

        $review->setAttribute('Score', '12');
        $this->assertFalse($review->validate(['Score']));

        $review->setAttribute('Score', '-12');
        $this->assertFalse($review->validate(['Score']));

        $review->setAttribute('Score', '8.9');
        $this->assertTrue($review->validate(['Score']));
    }

    public function testValidationIdjogo() {
        $review = new Review();

        $review->setAttribute('Id_Jogo', null);
        $this->assertFalse($review->validate(['Id_Jogo']));

        $review->setAttribute('Id_Jogo', '');
        $this->assertFalse($review->validate(['Id_Jogo']));

        $review->setAttribute('Id_Jogo', 'Este campo só pode ser do tipo integer');
        $this->assertFalse($review->validate(['Id_Jogo']));

        $review->setAttribute('Id_Jogo', '1');
        $this->assertTrue($review->validate(['Id_Jogo']));
    }

    public function testValidationIdutilizador() {
        $review = new Review();

        $review->setAttribute('Id_Utilizador', null);
        $this->assertFalse($review->validate(['Id_Utilizador']));

        $review->setAttribute('Id_Utilizador', '');
        $this->assertFalse($review->validate(['Id_Utilizador']));

        $review->setAttribute('Id_Utilizador', 'Este campo só pode ser do tipo integer');
        $this->assertFalse($review->validate(['Id_Utilizador']));

        $review->setAttribute('Id_Utilizador', '1');
        $this->assertTrue($review->validate(['Id_Utilizador']));
    }

    public function testValidateSave() {
        $review = new Review();

        $review->setAttribute('Descricao', 'TesteUnitJogo');
        $review->setAttribute('Data', date("Y-m-d"));
        $review->setAttribute('Score', '8.9');
        $review->setAttribute('Id_Jogo', '1');
        $review->setAttribute('Id_Utilizador', '1');

        $review->save();
        $this->tester->seeInDatabase('Review', ['Descricao' => 'TesteUnitJogo']);
    }

    public function testValidateChangeSave() {
        $review = Review::find()->where(['Descricao' => 'TesteUnitJogo'])->one();

        $review->setAttribute('Descricao', 'TesteUnitJogoUpdate');

        $review->save();

        $this->tester->seeRecord('\app\models\Review', ['Descricao' => 'TesteUnitJogoUpdate']);
        $this->tester->dontSeeRecord('\app\models\Review', ['Descricao' => 'TesteUnitJogo']);
    }

    public function testValidateDelete() {
        $review = Review::find()->where(['Descricao' => 'TesteUnitJogoUpdate'])->one();

        $review->delete();

        $this->tester->dontSeeRecord('\app\models\Review', ['Descricao' => 'TesteUnitJogoUpdate']);
    }

}
