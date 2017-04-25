<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'status')->dropDownList([ 'draft' => 'Черновик', 'published' => 'Опуликовано', 'deleted' => 'Удалено', ]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'anons')->
        widget(Widget::className(), [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 100,
                'imageUpload' => Url::to(['/site/image-upload']),
                'imageManagerJson' => Url::to(['/site/images-get']),
                'plugins' => [
                    'clips',
                    'fullscreen',
                    'imagemanager',
                ]
            ]
        ]);
        ?>


        <?= $form->field($model, 'text')->
                widget(Widget::className(), [
                    'settings' => [
                        'lang' => 'ru',
                        'minHeight' => 200,
                        'imageUpload' => Url::to(['/site/image-upload']),
                        'imageManagerJson' => Url::to(['/site/images-get']),
                        'plugins' => [
                            'clips',
                            'fullscreen',
                            'imagemanager',
                        ]
                    ]
                ]);
        ?>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true])->label("")->hiddenInput() ?>

        <?= $form->field($model, 'date')->textInput()->label("")->hiddenInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
