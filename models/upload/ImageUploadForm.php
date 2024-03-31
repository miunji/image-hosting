<?php

namespace app\models\upload;

use app\models\Files;
use Yii;
use yii\helpers\Inflector;

class ImageUploadForm extends Files
{
    public $images;

    public function rules()
    {
        return [
            [['images'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->images as $file) {
                $image = new Files();

                $transliteratedName = Inflector::slug($file->baseName, '-', true);
                $fileName = strtolower($transliteratedName) . '.' . $file->extension;

                while (file_exists('upload/images/' . $fileName)) {
                    $transliteratedName = Inflector::slug($file->baseName . '-' . Yii::$app->security->generateRandomString(2), '-', true);
                    $fileName = strtolower($transliteratedName) . '.' . $file->extension;
                }

                $file->saveAs('upload/images/' . $fileName);

                $image->file_name = $fileName;
                $image->save();
            }
            return true;
        } else {
            return false;
        }
    }
}
