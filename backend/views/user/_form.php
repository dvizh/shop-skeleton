<?php

use common\models\user\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\user\UserProfile;

/* @var $this yii\web\View */
/* @var $model backend\models\UserForm */
/* @var $profile common\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $roles yii\rbac\Role[] */
/* @var $permissions yii\rbac\Permission[] */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($model, 'username') ?>
        <?php echo $form->field($model, 'phone') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordInput() ?>
        <?php echo $form->field($model, 'status')->dropDownList(User::statuses()) ?>
        <?php echo $form->field($model, 'roles')->checkboxList($roles) ?>

        <?php if(!$model->model->isNewRecord && isset($profile)) { ?>
            <h3><?=Yii::t('backend', 'Profile');?></h3>
            <?php echo $form->field($profile, 'user_id')->textInput(['type' => 'hidden'])->label(false) ?>
            <?php echo $form->field($profile, 'firstname')->textInput(['maxlength' => 255]) ?>
            <?php echo $form->field($profile, 'middlename')->textInput(['maxlength' => 255]) ?>
            <?php echo $form->field($profile, 'lastname')->textInput(['maxlength' => 255]) ?>
            <?php echo $form->field($profile, 'gender')->dropDownlist([
                // UserProfile::GENDER_FEMALE => Yii::t('backend', 'Female'),
                // UserProfile::GENDER_MALE => Yii::t('backend', 'Male')
                UserProfile::GENDER_FEMALE => 'Женский',
                UserProfile::GENDER_MALE => 'Мужской'
            ]) ?>
        <?php } ?>

        <div class="form-group">
            <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
        </div>
    <?php ActiveForm::end(); ?>


</div>
