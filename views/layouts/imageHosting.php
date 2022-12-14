<?php

use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\bootstrap4\Html;
use app\models\UploadForm;

AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php $this->registerCsrfMetaTags() ?>
        <title>Хостинг изображений</title>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

        <div class="app">
            <!-- Форма -->
            <?php $form = ActiveForm::begin(['options' => [
                'enctype' => 'multipart/form-data', 
                'id' => 'uploadImage',
            ]]) ?>
            <?php $form->action = ['image/index'] ?>
            <?php $form->enableClientValidation = false ?>
                <?= $form->field(new UploadForm(), 'imageFiles[]')
                         ->fileInput(['multiple' => true, 'accept' => 'image/*'])
                         ->label('Выбрать изображения', ['id' => 'imageFiles_label']) ?>
                <?= Html::submitButton('Загрузить', ['id' => 'submit', 'disabled' => 'disabled']) ?>
            <?php ActiveForm::end() ?>

            <!-- Контент -->
            <div class="content">
                <?= $content ?>
            </div>

            <!-- Футтер -->
            <footer class="footer">
                Тестовое задание | <?= date('Y'); ?>
            </footer>
        </div>
        
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>