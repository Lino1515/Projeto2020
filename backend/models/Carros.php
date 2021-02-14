<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carros".
 *
 * @property int $id
 * @property string $marca
 * @property string $matricula
 */
class Carros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['marca', 'matricula'], 'required'],
            [['marca', 'matricula'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'marca' => 'Marca',
            'matricula' => 'Matricula',
        ];
    }
}
