<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comentariosreports;

/**
 * ComentariosreportsSearch represents the model behind the search form of `app\models\Comentariosreports`.
 */
class ComentariosreportsSearch extends Comentariosreports {

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
                [['Id_comentario', 'Id_utilizador'], 'integer'],
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
        $query = Comentariosreports::find();

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
          'Id_comentario' => $this->Id_comentario,
          'Id_utilizador' => $this->Id_utilizador,
          'Data' => $this->Data,
          ]);

          $query->andFilterWhere(['like', 'Descricao', $this->Descricao]);
         */
        $usermodel = User::find()->where(['username' => strtolower($this->Descricao)])->all();
        if ($usermodel == null) {
            $usermodel = $this->Descricao;
        } else {
            $usermodel = $usermodel[0]->id;
        }
        if ($this->Descricao == "")
            $usermodel = "";
        $query->andFilterWhere(['OR',
                ['like', 'LOWER(Data)', strtolower($this->Descricao)],
                ['like', 'LOWER(Descricao)', strtolower($this->Descricao)],
                ['like', 'LOWER(Id_utilizador)', strtolower($usermodel)],
        ]);
        return $dataProvider;
    }

}
