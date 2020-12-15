<?php

namespace app\v1\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 *
 * @property Comentarios[] $comentarios
 * @property Comentariosreports[] $comentariosreports
 * @property Comentarios[] $comentarios0
 * @property Comentariosutilizador[] $comentariosutilizadors
 * @property Comentarios[] $comentarios1
 * @property Review[] $reviews
 * @property Reviewreports[] $reviewreports
 * @property Review[] $reviews0
 * @property Reviewutilizador[] $reviewutilizadors
 * @property Review[] $reviews1
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Comentariosreports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentariosreports()
    {
        return $this->hasMany(Comentariosreports::className(), ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Comentarios0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios0()
    {
        return $this->hasMany(Comentarios::className(), ['Id' => 'Id_comentario'])->viaTable('comentariosreports', ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Comentariosutilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentariosutilizadors()
    {
        return $this->hasMany(Comentariosutilizador::className(), ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Comentarios1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios1()
    {
        return $this->hasMany(Comentarios::className(), ['Id' => 'Id_comentario'])->viaTable('comentariosutilizador', ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Reviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(Review::className(), ['Id_Utilizador' => 'id']);
    }

    /**
     * Gets query for [[Reviewreports]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewreports()
    {
        return $this->hasMany(Reviewreports::className(), ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Reviews0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews0()
    {
        return $this->hasMany(Review::className(), ['Id' => 'Id_review'])->viaTable('reviewreports', ['Id_utilizador' => 'id']);
    }

    /**
     * Gets query for [[Reviewutilizadors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewutilizadors()
    {
        return $this->hasMany(Reviewutilizador::className(), ['Id_Utilizador' => 'id']);
    }

    /**
     * Gets query for [[Reviews1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviews1()
    {
        return $this->hasMany(Review::className(), ['Id' => 'Id_review'])->viaTable('reviewutilizador', ['Id_Utilizador' => 'id']);
    }
}
