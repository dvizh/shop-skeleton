<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="slider-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="col-md-6 col-lg-4">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-lg-4">
        <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-lg-4">
        <?= $form->field($model, 'sort')->textInput(['type'=>'number']) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'short_text')->
        widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 100,
                //'imageUpload' => Url::to(['/site/image-upload']),
                //'imageManagerJson' => Url::to(['/site/images-get']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager',
                ]
            ]
        ]);
        ?>
    </div>

    <div class="col-md-12">
        <?=\dvizh\gallery\widgets\Gallery::widget(
            [
                'model' => $model,
                'previewSize' => '50x50',
                'fileInputPluginLoading' => true,
                'fileInputPluginOptions' => []
            ]
        ); ?>

        <br />

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
