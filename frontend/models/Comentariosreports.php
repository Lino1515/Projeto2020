<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentariosreports".
 *
 * @property int $Id_comentario
 * @property int $Id_utilizador
 * @property string $Data
 * @property string $Descricao
 *
 * @property User $utilizador
 * @property Comentarios $comentario
 */
class Comentariosreports extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentariosreports';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Id_comentario', 'Id_utilizador', 'Data', 'Descricao'], 'required'],
            [['Id_comentario', 'Id_utilizador'], 'integer'],
            [['Data'], 'safe'],
            [['Descricao'], 'string'],
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
            'Data' => 'Data',
            'Descricao' => 'Descricao',
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
