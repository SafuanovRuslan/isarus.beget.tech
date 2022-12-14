<?php

namespace app\models;

use yii\db\ActiveRecord;

class Image extends ActiveRecord {
    public static function tableName()
    {
        return 'images';
    }

    public function rules()
    {
        return [
            [['id', 'created_at'], 'integer'],
            [['title'], 'string'],
        ];
    }
}