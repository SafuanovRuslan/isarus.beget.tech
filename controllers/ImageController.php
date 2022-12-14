<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\Image;
use app\models\UploadForm;
use yii\data\ActiveDataProvider;

class ImageController extends Controller
{
    public $layout = 'imageHosting';

    public function actionIndex()
    {
        $page = Yii::$app->request->get('page') ?? 1;
        $model = new UploadForm();
        $dataProvider = new ActiveDataProvider([
            'query' => Image::find(),
            'pagination' => [
                'pageSize' => 25,
            ],
        ]);

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                return $this->redirect(['image/index']);
            } else {
                return $this->redirect(['image/index']);
            }
        }

        return $this->render('index', compact('dataProvider'));
    }
}
