<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jogos;

/**
 * JogosSearch represents the model behind the search form of `app\models\Jogos`.
 */
class JogosSearch extends Jogos {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['Id', 'Id_tipojogo'], 'integer'],
                [['Nome', 'Descricao', 'Data', 'Trailer', 'Imagem'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Jogos::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Id' => $this->Id,
            'Data' => $this->Data,
            'Id_tipojogo' => $this->Id_tipojogo,
        ]);

        /* $query->andFilterWhere(['like', 'LOWER(Nome)', strtolower($this->Nome)]),
          ->andFilterWhere(['like', 'LOWER(Descricao)', strtolower($this->Nome]))
          ->andFilterWhere(['like', 'LOWER(Trailer)', strtolower($this->Trailer])
          ->andFilterWhere(['like', 'LOWER(Imagem)', strtolower($this->Imagem]); */

        if ($this->Nome == "") {
            $tipojogomodel = $this->Nome;
        } else {
            $tipojogomodel = Tipojogo::find()->where(['Nome' => $this->Nome])->all();
           /* var_dump($this->Nome);
            var_dump($tipojogomodel);
            echo 'ELO';
            exit;*/
            if ($tipojogomodel == null) {
                $tipojogomodel = $this->Nome;
            } else {
                $tipojogomodel = $tipojogomodel[0]->Id;
            }
        }
        $query->andFilterWhere(['OR',
                ['like', 'LOWER(Nome)', strtolower($this->Nome)],
                ['like', 'LOWER(Descricao)', strtolower($this->Nome)],
                ['like', 'LOWER(Trailer)', strtolower($this->Nome)],
                ['like', 'LOWER(Imagem)', strtolower($this->Nome)],
                ['like', 'LOWER(Id_tipojogo)', strtolower($tipojogomodel)],
        ]);
        return $dataProvider;
    }

}
