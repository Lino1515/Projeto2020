<?php

namespace backend\tests\unit;

use common\fixtures\UserFixture;
use app\models\Jogos;

class JogosTest extends \Codeception\Test\Unit {

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
    /*  public function testSomeFeature()
      {

      } */

    public function testValidationId() {
        $jogos = new Jogos();

        $jogos->setAttribute('Id', 'Este Item so aceita int.');
        $this->assertFalse($jogos->validate(['Id']));

        $jogos->setAttribute('Id', '1');
        $this->assertTrue($jogos->validate(['Id']));

        $jogos->setAttribute('Id', '');
        $this->assertTrue($jogos->validate(['Id']));
    }

    public function testValidationNome() {
        $jogos = new Jogos();

        $jogos->setAttribute('Nome', null);
        $this->assertFalse($jogos->validate(['Nome']));

        $jogos->setAttribute('Nome', '');
        $this->assertFalse($jogos->validate(['Nome']));

        $jogos->setAttribute('Nome', 'ESTE TESTE TEM MAIS DE 120 Chars??????????????????????????????????????????????????????????????????????????????????????????');
        $this->assertFalse($jogos->validate(['Nome']));

        $jogos->setAttribute('Nome', 'Marvel Movies Lego');
        $this->assertTrue($jogos->validate(['Nome']));
    }

    public function testValidationDescricao() {
        $jogos = new Jogos();

        $jogos->setAttribute('Descricao', null);
        $this->assertFalse($jogos->validate(['Descricao']));

        $jogos->setAttribute('Descricao', '');
        $this->assertFalse($jogos->validate(['Descricao']));

        $jogos->setAttribute('Descricao', 'Aqui podemos escrever o quanto quisermos nao tem limite na base de dados, porem temos que realizar testes na mesma para ver se esta tudo bem.');
        $this->assertTrue($jogos->validate(['Descricao']));
    }

    public function testValidationData() {
        $jogos = new Jogos();

        $jogos->setAttribute('Data', null);
        $this->assertFalse($jogos->validate(['Data']));

        $jogos->setAttribute('Data', 'Este Item so aceita int.');
        $this->assertFalse($jogos->validate(['Data']));

        $jogos->setAttribute('Data', date("Y-m-d"));
        $this->assertTrue($jogos->validate(['Data']));
    }

    public function testValidationTrailer() {
        $jogos = new Jogos();

        $jogos->setAttribute('Trailer', null);
        $this->assertFalse($jogos->validate(['Trailer']));

        $jogos->setAttribute('Trailer', '');
        $this->assertFalse($jogos->validate(['Trailer']));

        $jogos->setAttribute('Trailer', 'https://www.youtube.com/watch?v=gkTb9GP9lVI&ab_channel=JwHDify');
        $this->assertFalse($jogos->validate(['Trailer']));

        $jogos->setAttribute('Trailer', 'gkTb9GP9lVI');
        $this->assertTrue($jogos->validate(['Trailer']));
    }

    public function testValidationIdtipojogo() {
        $jogos = new Jogos();

        $jogos->setAttribute('Id_tipojogo', null);
        $this->assertFalse($jogos->validate(['Id_tipojogo']));

        $jogos->setAttribute('Id_tipojogo', '');
        $this->assertFalse($jogos->validate(['Id_tipojogo']));

        $jogos->setAttribute('Id_tipojogo', 'Este campo só pode ser do tipo integer');
        $this->assertFalse($jogos->validate(['Id_tipojogo']));

        $jogos->setAttribute('Id_tipojogo', '1');
        $this->assertTrue($jogos->validate(['Id_tipojogo']));
    }

    public function testValidationImagem() {
        //É do tipo string porem nao é obrigatorio ter imagem
        $jogos = new Jogos();

        $jogos->setAttribute('Imagem', null);
        $this->assertTrue($jogos->validate(['Imagem']));

        $jogos->setAttribute('Imagem', '');
        $this->assertTrue($jogos->validate(['Imagem']));

        $jogos->setAttribute('Imagem', 'Este campo só aceitara caminhos para a pasta.');
        $this->assertTrue($jogos->validate(['Imagem']));
    }

    public function testValidateSave() {
        $jogos = new jogos();

        $jogos->setAttribute('Nome', 'TesteUnitJogo');
        $jogos->setAttribute('Descricao', 'TesteUnitJogo');
        $jogos->setAttribute('Data', date("Y-m-d"));
        $jogos->setAttribute('Trailer', 'gkTb9GP9lVI');
        $jogos->setAttribute('Id_tipojogo', '1');
        $jogos->setAttribute('Imagem', '');

        $jogos->save();
        $this->tester->seeInDatabase('jogos', ['Nome' => 'TesteUnitJogo']);
    }

    public function testValidateChangeSave() {
        $jogos = Jogos::find()->where(['Nome' => 'TesteUnitJogo'])->one();

        $jogos->setAttribute('Nome', 'TesteUnitJogoUpdate');

        $jogos->save();

        $this->tester->seeRecord('app\models\Jogos', ['Nome' => 'TesteUnitJogoUpdate']);
        $this->tester->dontSeeRecord('app\models\Jogos', ['Nome' => 'TesteUnitJogo']);
    }

    public function testValidateDelete() {
        $jogos = Jogos::find()->where(['Nome' => 'TesteUnitJogoUpdate'])->one();

        $jogos->delete();

        $this->tester->dontSeeRecord('app\models\Jogos', ['Nome' => 'TesteUnitJogoUpdate']);
    }

}
