<?php

namespace app\modules\v1\models;

use Yii;

/**
 * This is the model class for table "upload_imagem".
 *
 * @property int $id
 * @property string $path
 * @property string $nome
 * @property int $id_user
 */
class Uploadimagem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'upload_imagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'nome', 'id_user'], 'required'],
            [['id_user'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['nome'], 'string', 'max' => 80],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'nome' => 'Nome',
            'id_user' => 'Id User',
        ];
    }
}
