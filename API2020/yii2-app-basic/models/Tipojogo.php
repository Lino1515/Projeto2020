<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipojogo".
 *
 * @property int $Id
 * @property string $Nome
 * @property string $Descricao
 *
 * @property Jogos[] $jogos
 */
class Tipojogo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tipojogo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome', 'Descricao'], 'required'],
            [['Descricao'], 'string'],
            [['Nome'], 'string', 'max' => 120],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Nome' => 'Nome',
            'Descricao' => 'Descricao',
        ];
    }

    /**
     * Gets query for [[Jogos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJogos()
    {
        return $this->hasMany(Jogos::className(), ['Id_tipojogo' => 'Id']);
    }
}
