<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $Id
 * @property string $Data
 * @property string $Descricao
 * @property float $Score
 * @property int $Id_Jogo
 * @property int $Id_Utilizador
 *
 * @property User $utilizador
 * @property Jogos $jogo
 * @property Reviewreports[] $reviewreports
 * @property User[] $utilizadors
 * @property Reviewutilizador[] $reviewutilizadors
 * @property User[] $utilizadors0
 */
class Review extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['Data', 'Descricao', 'Score', 'Id_Jogo', 'Id_Utilizador'], 'required'],
            [['Data'], 'safe'],
            [['Descricao'], 'string'],
            [['Score'], 'number'],
            [['Id_jogo', 'Id_utilizador'], 'integer'],
            [['Id_utilizador'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Id_utilizador' => 'id']],
            [['Id_jogo'], 'exist', 'skipOnError' => true, 'targetClass' => Jogos::className(), 'targetAttribute' => ['Id_jogo' => 'Id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'Id' => 'ID',
            'Data' => 'Data',
            'Descricao' => 'Descricao',
            'Score' => 'Score',
            'Id_jogo' => 'Id Jogo',
            'Id_utilizador' => 'Id Utilizador',
        ];
    }

    /**
     * Gets query for [[Utilizador]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizador() {
        return $this->hasOne(User::className(), ['id' => 'Id_utilizador']);
    }

    /**
     * Gets query for [[Jogo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJogo() {
        return $this->hasOne(Jogos::className(), ['Id' => 'Id_jogo']);
    }

    /**
     * Gets query for [[Reviewreports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewreports() {
        return $this->hasMany(Reviewreports::className(), ['Id_review' => 'Id']);
    }

    /**
     * Gets query for [[Utilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors() {
        return $this->hasMany(User::className(), ['id' => 'Id_utilizador'])->viaTable('reviewreports', ['Id_review' => 'Id']);
    }

    /**
     * Gets query for [[Reviewutilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewutilizadors() {
        return $this->hasMany(Reviewutilizador::className(), ['Id_review' => 'Id']);
    }

    /**
     * Gets query for [[Utilizadors0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUtilizadors0() {
        return $this->hasMany(User::className(), ['id' => 'Id_Utilizador'])->viaTable('reviewutilizador', ['Id_review' => 'Id']);
    }

}
