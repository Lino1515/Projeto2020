<?php

namespace app\modules\v1\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Uploadimagem;

/**
 * UploadImagemSearch represents the model behind the search form of `app\models\UploadImagem`.
 */
class UploadimagemSearch extends UploadImagem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_user'], 'integer'],
            [['path', 'nome'], 'safe'],
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
        $query = UploadImagem::find();

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
            'id' => $this->id,
            'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'nome', $this->nome]);

        return $dataProvider;
    }
}
