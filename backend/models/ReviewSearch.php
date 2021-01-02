<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Review;

/**
 * ReviewSearch represents the model behind the search form of `app\models\Review`.
 */
class ReviewSearch extends Review {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['Id', 'Id_Jogo', 'Id_Utilizador'], 'integer'],
                [['Data', 'Descricao'], 'safe'],
                [['Score'], 'number'],
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
        $query = Review::find();

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
        /* $query->andFilterWhere([
          'Id' => $this->Id,
          'Data' => $this->Data,
          'Score' => $this->Score,
          'Id_Jogo' => $this->Id_Jogo,
          'Id_Utilizador' => $this->Id_Utilizador,
          ]);

          $query->andFilterWhere(['like', 'Descricao', $this->Descricao]); */
        $usermodel = User::find()->where(['username' => strtolower($this->Descricao)])->all();
        if ($usermodel == null) {
            $usermodel = $this->Id_Jogo;
        } else {
            $usermodel = $usermodel[0]->id;
        }
        $likeCondition = new \yii\db\conditions\LikeCondition('LOWER(Nome)', 'LIKE', strtolower($this->Descricao) . '%');
        $likeCondition->setEscapingReplacements(false);
        $jogomodel = Jogos::find()->where($likeCondition)->all();

        if ($jogomodel == null) {
            $jogomodel = $this->Id_Jogo;
        } else {
            $jogomodel = $jogomodel[0]->Id;
        }
        $query->andFilterWhere(['OR',
                ['like', 'LOWER(Data)', strtolower($this->Descricao)],
                ['like', 'LOWER(Descricao)', strtolower($this->Descricao)],
                ['like', 'LOWER(Score)', strtolower($this->Descricao)],
                ['like', 'LOWER(Id_Jogo)', strtolower($jogomodel)],
                ['like', 'LOWER(Id_Utilizador)', strtolower($usermodel)],
        ]);
        return $dataProvider;
    }

}
