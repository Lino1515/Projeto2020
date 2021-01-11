<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "jogos".
 *
 * @property int $Id
 * @property string $Nome
 * @property string $Descricao
 * @property string $Data
 * @property string $Trailer
 * @property string $Imagem
 * @property int $Id_tipojogo
 *
 * @property Comentarios[] $comentarios
 * @property Tipojogo $tipojogo
 * @property Review[] $reviews
 */
class Jogos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jogos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Nome', 'Descricao', 'Data', 'Trailer', 'Imagem', 'Id_tipojogo'], 'required'],
            [['Descricao'], 'string'],
            [['Data'], 'safe'],
            [['Id_tipojogo'], 'integer'],
            [['Nome'], 'string', 'max' => 120],
            [['Trailer', 'Imagem'], 'string', 'max' => 255],
            [['Id_tipojogo'], 'exist', 'skipOnError' => true, 'targetClass' => Tipojogo::className(), 'targetAttribute' => ['Id_tipojogo' => 'Id']],
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
            'Data' => 'Data',
            'Trailer' => 'Trailer',
            'Imagem' => 'Imagem',
            'Id_tipojogo' => 'Id Tipojogo',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['Id_jogo' => 'Id']);
    }

    /**
     * Gets query for [[Tipojogo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipojogo()
    {
        return $this->hasOne(Tipojogo::className(), ['Id' => 'Id_tipojogo']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['Id_Jogo' => 'Id']);
    }
}
