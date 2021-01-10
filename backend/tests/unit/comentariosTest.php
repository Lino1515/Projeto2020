<?php

namespace backend\tests;

use common\fixtures\UserFixture;
use \app\models\Comentarios;

class comentariosTest extends \Codeception\Test\Unit {

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
        $comentario = new Comentarios();

        $comentario->setAttribute('Id', null);
        $this->assertFalse($comentario->validate(['Descricao']));

        $comentario->setAttribute('Id', 'Este Item so aceita int.');
        $this->assertFalse($comentario->validate(['Id']));

        $comentario->setAttribute('Id', '1');
        $this->assertTrue($comentario->validate(['Id']));
    }

    public function testValidationDescricao() {
        $comentario = new Comentarios();

        $comentario->setAttribute('Descricao', null);
        $this->assertFalse($comentario->validate(['Descricao']));

        $comentario->setAttribute('Descricao', '');
        $this->assertFalse($comentario->validate(['Descricao']));

        $comentario->setAttribute('Descricao', 'Aqui podemos escrever o quanto quisermos nao tem limite na base de dados, porem temos que realizar testes na mesma para ver se esta tudo bem.');
        $this->assertTrue($comentario->validate(['Descricao']));
    }

    public function testValidationData() {
        $comentario = new Comentarios();

        $comentario->setAttribute('Data', null);
        $this->assertFalse($comentario->validate(['Data']));

        $comentario->setAttribute('Data', 'Este Item so aceita int.');
        $this->assertFalse($comentario->validate(['Data']));

        $comentario->setAttribute('Data', date("Y-m-d"));
        $this->assertTrue($comentario->validate(['Data']));
    }

    public function testValidationIdjogo() {
        $comentario = new Comentarios();

        $comentario->setAttribute('Id_jogo', null);
        $this->assertFalse($comentario->validate(['Id_jogo']));

        $comentario->setAttribute('Id_jogo', '');
        $this->assertFalse($comentario->validate(['Id_jogo']));

        $comentario->setAttribute('Id_jogo', 'Este campo só pode ser do tipo integer');
        $this->assertFalse($comentario->validate(['Id_jogo']));

        $comentario->setAttribute('Id_jogo', '1');
        $this->assertTrue($comentario->validate(['Id_jogo']));
    }

    public function testValidationIdutilizador() {
        $comentario = new Comentarios();

        $comentario->setAttribute('Id_utilizador', null);
        $this->assertFalse($comentario->validate(['Id_utilizador']));

        $comentario->setAttribute('Id_utilizador', '');
        $this->assertFalse($comentario->validate(['Id_utilizador']));

        $comentario->setAttribute('Id_utilizador', 'Este campo só pode ser do tipo integer');
        $this->assertFalse($comentario->validate(['Id_utilizador']));

        $comentario->setAttribute('Id_utilizador', '1');
        $this->assertTrue($comentario->validate(['Id_utilizador']));
    }

    public function testValidateSave() {
        $comentario = new Comentarios();

        $comentario->setAttribute('Descricao', 'TesteUnitJogo');
        $comentario->setAttribute('Data', date("Y-m-d"));
        $comentario->setAttribute('Id_jogo', '1');
        $comentario->setAttribute('Id_utilizador', '1');

        $comentario->save();
        $this->tester->seeInDatabase('comentarios', ['Descricao' => 'TesteUnitJogo']);
    }

    public function testValidateChangeSave() {
        $comentario = Comentarios::find()->where(['Descricao' => 'TesteUnitJogo'])->one();

        $comentario->setAttribute('Descricao', 'TesteUnitJogoUpdate');

        $comentario->save();

        $this->tester->seeRecord('\app\models\Comentarios', ['Descricao' => 'TesteUnitJogoUpdate']);
        $this->tester->dontSeeRecord('\app\models\Comentarios', ['Descricao' => 'TesteUnitJogo']);
    }

    public function testValidateDelete() {
        $comentario = Comentarios::find()->where(['Descricao' => 'TesteUnitJogoUpdate'])->one();

        $comentario->delete();

        $this->tester->dontSeeRecord('\app\models\Comentarios', ['Descricao' => 'TesteUnitJogoUpdate']);
    }

}
