<?php

namespace app\v1\models;

use Yii;

/**
 * This is the model class for table "comentariosutilizador".
 *
 * @property int $Id_comentario
 * @property int $Id_utilizador
 * @property int $Like_Dislike
 *
 * @property User $utilizador
 * @property Comentarios $comentario
 */
class Comentariosutilizador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentariosutilizador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_comentario', 'Id_utilizador', 'Like_Dislike'], 'required'],
            [['Id_comentario', 'Id_utilizador', 'Like_Dislike'], 'integer'],
            [['Id_comentario', 'Id_utilizador'], 'unique', 'targetAttribute' => ['Id_comentario', 'Id_utilizador']],
            [['Id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_utilizador' => 'id']],
            [['Id_comentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::className(), 'targetAttribute' => ['Id_comentario' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id_comentario' => 'Id Comentario',
            'Id_utilizador' => 'Id Utilizador',
            'Like_Dislike' => 'Like Dislike',
        ];
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador()
    {
        return $this->hasOne(User::className(), ['id' => 'Id_utilizador']);
    }

    /**
     * Gets query for [[Comentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentario()
    {
        return $this->hasOne(Comentarios::className(), ['Id' => 'Id_comentario']);
    }
}
