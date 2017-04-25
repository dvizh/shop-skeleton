<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = 'Аккаунт';
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php echo $form->field($model, 'password')->passwordInput()->label('Новый пароль') ?>

    <?php echo $form->field($model, 'password_confirm')->passwordInput()->label('Новый пароль еще раз') ?>

    <div class="form-group">
        <?php echo Html::submitButton('Редактировать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
