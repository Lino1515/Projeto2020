<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tipojogo;

/**
 * TipojogoSearch represents the model behind the search form of `app\models\Tipojogo`.
 */
class TipojogoSearch extends Tipojogo {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['Id'], 'integer'],
                [['Nome', 'Descricao'], 'safe'],
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

        $query = Tipojogo::find();

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
        ]);

        /* $query->andFilterWhere(['like', 'Nome', $this->Nome])
          ->andFilterWhere(['like', 'Descricao', $this->Descricao]); */
        $query->andFilterWhere(['OR',
                ['like', 'LOWER(Nome)', strtolower($this->Nome)],
                ['like', 'LOWER(Descricao)', strtolower($this->Nome)],
                ['like', 'Descricao', $this->Nome],
        ]);

        return $dataProvider;
    }

}
