<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviewreports".
 *
 * @property int $Id_review
 * @property int $Id_utilizador
 * @property string $Data
 * @property string $Descricao
 *
 * @property User $utilizador
 * @property Review $review
 */
class Reviewreports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviewreports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_review', 'Id_utilizador', 'Data', 'Descricao'], 'required'],
            [['Id_review', 'Id_utilizador'], 'integer'],
            [['Data'], 'safe'],
            [['Descricao'], 'string'],
            [['Id_review', 'Id_utilizador'], 'unique', 'targetAttribute' => ['Id_review', 'Id_utilizador']],
            [['Id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_utilizador' => 'id']],
            [['Id_review'], 'exist', 'skipOnError' => true, 'targetClass' => Review::className(), 'targetAttribute' => ['Id_review' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id_review' => 'Id Review',
            'Id_utilizador' => 'Id Utilizador',
            'Data' => 'Data',
            'Descricao' => 'Descricao',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_utilizador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::className(), ['Id' => 'Id_review']);
    }
}
