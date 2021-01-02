<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comentarios;

/**
 * ComentariosSearch represents the model behind the search form of `app\models\Comentarios`.
 */
class ComentariosSearch extends Comentarios {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['Id', 'Id_utilizador', 'Id_jogo'], 'integer'],
                [['Data', 'Descricao'], 'safe'],
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
        /* $query->andFilterWhere([
          'Id' => $this->Id,
          'Data' => $this->Data,
          'Id_utilizador' => $this->Id_utilizador,
          'Id_jogo' => $this->Id_jogo,
          ]);

          $query->andFilterWhere(['like', 'Descricao', $this->Descricao]); */
        $usermodel = User::find()->where(['username' => strtolower($this->Descricao)])->all();
        if ($usermodel == null) {
            $usermodel = $this->Descricao;
        } else {
            $usermodel = $usermodel[0]->id;
        }

        $likeCondition = new \yii\db\conditions\LikeCondition('LOWER(Nome)', 'LIKE', strtolower($this->Descricao) . '%');
        $likeCondition->setEscapingReplacements(false);
        $jogomodel = Jogos::find()->where($likeCondition)->all();

        if ($jogomodel == null) {
            $jogomodel = $this->Descricao;
        } else {
            $jogomodel = $jogomodel[0]->Id;
        }
        if ($this->Descricao == "") {
            $usermodel = "";
            $jogomodel = "";
        }
        $query->andFilterWhere(['OR',
                ['like', 'LOWER(Data)', strtolower($this->Descricao)],
                ['like', 'LOWER(Descricao)', strtolower($this->Descricao)],
                ['like', 'LOWER(Id_utilizador)', strtolower($usermodel)],
                ['like', 'LOWER(Id_jogo)', strtolower($jogomodel)],
        ]);
        return $dataProvider;
    }

}
