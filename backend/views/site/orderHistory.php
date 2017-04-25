<?php

use yii\helpers\Url;
use yii\helpers\Html;
use nex\datepicker\DatePicker;
use kartik\grid\GridView;



$this->title = 'История заказов';
$this->params['breadcrumbs'][] = $this->title;


if($dateStart = yii::$app->request->get('date_start')) {
    $dateStart = date('Y-m-d', strtotime($dateStart));
}

if($dateStop = yii::$app->request->get('date_stop')) {
    $dateStop = date('Y-m-d', strtotime($dateStop));
}

$timeStart = yii::$app->request->get('time_start');
$timeStop = yii::$app->request->get('time_stop');

?>



<div class="order-history">

    <?= Html::a(yii::t('order', 'Create order'), ['/order/order/create'], ['class' => 'btn btn-success']) ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'client_name',
            'count',
            'phone',
            'email',
            'base_cost',
            'cost',
            'status',
            'date',
            'payment',
            'comment',
            'address',
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::toRoute(['/order/order/view', 'id' => $model->id]);
                    }
                    if ($action === 'view') {
                        return Url::toRoute(['/order/order/update', 'id' => $model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::toRoute(['/order/order/delete', 'id' => $model->id]);
                    }
                },
                'template' => '{view} {update} {delete}',
                'buttonOptions' => ['class' => 'btn btn-default'],
                'options' => ['style' => 'width: 125px;']
            ],
        ],
    ]);
    ?>



</div>
