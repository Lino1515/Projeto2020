<?php

namespace app\v1\models;

use Yii;

/**
 * This is the model class for table "reviewutilizador".
 *
 * @property int $Id_review
 * @property int $Id_Utilizador
 * @property int $Helpful_UnHelpful
 *
 * @property User $utilizador
 * @property Review $review
 */
class Reviewutilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviewutilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_review', 'Id_Utilizador', 'Helpful_UnHelpful'], 'required'],
            [['Id_review', 'Id_Utilizador', 'Helpful_UnHelpful'], 'integer'],
            [['Id_review', 'Id_Utilizador'], 'unique', 'targetAttribute' => ['Id_review', 'Id_Utilizador']],
            [['Id_Utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_Utilizador' => 'id']],
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
            'Id_Utilizador' => 'Id Utilizador',
            'Helpful_UnHelpful' => 'Helpful Un Helpful',
        ];
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_Utilizador']);
    }

    /**
     * Gets query for [[Review]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Review::className(), ['Id' => 'Id_review']);
    }
}
