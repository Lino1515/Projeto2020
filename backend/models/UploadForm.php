<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model {

    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules() {
        return [
                [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload() {
        echo "Upload MODEL";
        exit();
        if ($this->validate()) {
            $this->imageFile->saveAs('Projeto2020\backend\web\Imagens\imagem_backend/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
