<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $Id
 * @property string $Data
 * @property string $Descricao
 * @property int $Id_utilizador
 * @property int $Id_jogo
 *
 * @property User $utilizador
 * @property Jogos $jogo
 * @property Comentariosreports[] $comentariosreports
 * @property User[] $utilizadors
 * @property Comentariosutilizador[] $comentariosutilizadors
 * @property User[] $utilizadors0
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Data', 'Descricao', 'Id_utilizador', 'Id_jogo'], 'required'],
            [['Id'], 'integer'],
            [['Data'], 'date', 'format' => 'php:Y-m-d'],
            [['Descricao'], 'string'],
            [['Id_utilizador', 'Id_jogo'], 'integer'],
            [['Id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_utilizador' => 'id']],
            [['Id_jogo'], 'exist', 'skipOnError' => true, 'targetClass' => Jogos::className(), 'targetAttribute' => ['Id_jogo' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Data' => 'Data',
            'Descricao' => 'Descricao',
            'Id_utilizador' => 'Id Utilizador',
            'Id_jogo' => 'Id Jogo',
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
    public function getJogo()
    {
        return $this->hasOne(Jogos::className(), ['Id' => 'Id_jogo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentariosreports()
    {
        return $this->hasMany(Comentariosreports::className(), ['Id_comentario' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors()
    {
        return $this->hasMany(User::className(), ['id' => 'Id_utilizador'])->viaTable('comentariosreports', ['Id_comentario' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentariosutilizadors()
    {
        return $this->hasMany(Comentariosutilizador::className(), ['Id_comentario' => 'Id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors0()
    {
        return $this->hasMany(User::className(), ['id' => 'Id_utilizador'])->viaTable('comentariosutilizador', ['Id_comentario' => 'Id']);
    }
}
