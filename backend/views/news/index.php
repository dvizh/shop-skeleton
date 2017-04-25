<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'anons',
           // 'text:ntext',
          //  'slug',
             'date',
            [
                'attribute' =>'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    ['draft' => 'Черновик','published' => 'Опубликовано', 'deleted' => 'Удалено'],
                    ['class' => 'form-control', 'prompt' => 'Статус']
                ),
                'format' => 'raw',
                'value' => function($model){
                    $translate = ['draft' => 'Черновик','published' => 'Опубликовано', 'deleted' => 'Удалено'];
                    return $translate[$model->status];
                }
            ],

             //'status',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
