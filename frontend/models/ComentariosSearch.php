<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Comentarios;

/**
 * ComentariosSearch represents the model behind the search form of `app\models\Comentarios`.
 */
class ComentariosSearch extends Comentarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id', 'Id_utilizador', 'Id_jogo'], 'integer'],
            [['Data', 'Descricao'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
    public function search($params)
    {
        $query = Comentarios::find();

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
            'Id_utilizador' => $this->Id_utilizador,
            'Id_jogo' => $this->Id_jogo,
        ]);

        $query->andFilterWhere(['like', 'Descricao', $this->Descricao]);

        return $dataProvider;
    }
}
