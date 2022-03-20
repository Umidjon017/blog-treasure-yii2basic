<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png,jpeg,gif'],
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if ($this->validate())
        {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
    }

    private function generatePhotoName()
    {
        return strtolower(md5(uniqid($this->image->baseName))). '.' . $this->image->extension;
    }

    private function getPhotoAlias($currentImage)
    {
        return Yii::getAlias('@web'). 'uploads/' . $currentImage;
    }

    public function deleteCurrentImage($currentImage)
    {
        if ($this->isPhotoExists($currentImage))
        {
            unlink($this->getPhotoAlias($currentImage));
        }
    }

    private function isPhotoExists($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null)
        {
            return file_exists($this->getPhotoAlias($currentImage));
        };
    }

    public function saveImage()
    {
        $fileName = $this->generatePhotoName();
        $this->image->saveAs(Yii::getAlias('@web'). 'uploads/' . $fileName);

        return $fileName;
    }
}