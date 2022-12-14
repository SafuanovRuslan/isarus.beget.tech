<?php

namespace app\models;

use yii\base\Model;
use app\models\Image;
use Exception;
use yii\helpers\Inflector;

class UploadForm extends Model
{
    /**
     * @var UploadedFiles
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 5],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                try {
                    $image = new Image();
                    $image->title = $this->getTitle($file->baseName . '.' . $file->extension);
                    $image->created_at = time();
                    $image->save();
                } catch (Exception $e) {
                    $image->title = $this->getRandomTitle($image->title, $file->extension);
                    $image->save();
                }
                

                try {
                    $file->saveAs('images/' . $image->title);
                } catch (\Exception $e) {
                    mkdir('images');
                    $file->saveAs('images/' . $image->title);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function getTitle($string)
    {
        return mb_strtolower( Inflector::transliterate($string) );
    }

    public function getRandomTitle($string, $extension)
    {
        return mb_strtolower( md5($string . microtime()) ) . '.' . $extension;
    }
}