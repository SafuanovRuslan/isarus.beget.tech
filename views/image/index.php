<?php

use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'summary' => 'Показаны изображения <b>{begin}-{end}</b>. Всего изображений <b>{totalCount}</b>',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Предпросмотр',
            'format' => 'raw',
            'value' => function($data) {
                $src = Yii::getAlias('@images') . '/' . $data->title;
                return Html::img($src, [
                    'width' => '50px',
                ]);
            }
        ],
        [
            'attribute'=>'title',
            'label' => 'Название файла',
            'value' => function($data) {
                return $data->title;
            }
        ],
        [
            'attribute'=>'created_at',
            'label' => 'Время создания',
            'value' => function($data) {
                return date('d.m.Y H:i:s', $data->created_at);
            }
        ],
        [
            'label' => 'Ссылка',
            'format' => 'raw',
            'value' => function($data) {
                $url = Yii::getAlias('@images') . '/' . $data->title;
                return Html::a($data->title, $url, [
                    'target' => '_blank',
                ]);
            }
        ],
    ],
]);
