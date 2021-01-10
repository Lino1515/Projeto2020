<?php

namespace backend\tests;

use common\fixtures\UserFixture;
use app\models\Tipojogo;

class tipojogoTest extends \Codeception\Test\Unit {

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
        $tipojogo = new Tipojogo();

        $tipojogo->setAttribute('Id', null);
        $this->assertFalse($tipojogo->validate(['Descricao']));

        $tipojogo->setAttribute('Id', 'Este Item so aceita int.');
        $this->assertFalse($tipojogo->validate(['Id']));

        $tipojogo->setAttribute('Id', '1');
        $this->assertTrue($tipojogo->validate(['Id']));
    }

    public function testValidationNome() {
        $tipojogo = new Tipojogo();

        $tipojogo->setAttribute('Nome', null);
        $this->assertFalse($tipojogo->validate(['Nome']));

        $tipojogo->setAttribute('Nome', '');
        $this->assertFalse($tipojogo->validate(['Nome']));

        $tipojogo->setAttribute('Nome', 'ESTE TESTE TEM MAIS DE 120 Chars??????????????????????????????????????????????????????????????????????????????????????????');
        $this->assertFalse($tipojogo->validate(['Nome']));

        $tipojogo->setAttribute('Nome', 'Marvel Movies Lego');
        $this->assertTrue($tipojogo->validate(['Nome']));
    }

    public function testValidationDescricao() {
        $tipojogo = new Tipojogo();

        $tipojogo->setAttribute('Descricao', null);
        $this->assertFalse($tipojogo->validate(['Descricao']));

        $tipojogo->setAttribute('Descricao', '');
        $this->assertFalse($tipojogo->validate(['Descricao']));

        $tipojogo->setAttribute('Descricao', 'Aqui podemos escrever o quanto quisermos nao tem limite na base de dados, porem temos que realizar testes na mesma para ver se esta tudo bem.');
        $this->assertTrue($tipojogo->validate(['Descricao']));
    }

    public function testValidateSave() {
        $tipojogo = new Tipojogo();

        $tipojogo->setAttribute('Nome', 'TesteUnitJogo');
        $tipojogo->setAttribute('Descricao', 'TesteUnitJogo');

        $tipojogo->save();
        $this->tester->seeInDatabase('tipojogo', ['Nome' => 'TesteUnitJogo']);
    }

    public function testValidateChangeSave() {
        $tipojogo = Tipojogo::find()->where(['Nome' => 'TesteUnitJogo'])->one();

        $tipojogo->setAttribute('Nome', 'TesteUnitJogoUpdate');

        $tipojogo->save();

        $this->tester->seeRecord('app\models\Tipojogo', ['Nome' => 'TesteUnitJogoUpdate']);
        $this->tester->dontSeeRecord('app\models\Tipojogo', ['Nome' => 'TesteUnitJogo']);
    }

    public function testValidateDelete() {
        $tipojogo = Tipojogo::find()->where(['Nome' => 'TesteUnitJogoUpdate'])->one();

        $tipojogo->delete();

        $this->tester->dontSeeRecord('app\models\Tipojogo', ['Nome' => 'TesteUnitJogoUpdate']);
    }

}
