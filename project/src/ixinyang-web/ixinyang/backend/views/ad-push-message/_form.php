<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdPushMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-push-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'messageTopic')->textInput() ?>

    <?= $form->field($model, 'pushIntroduction')->textArea() ?>

    <?= $form->field($model, 'pushDetails')->textArea() ?>

    <?= $form->field($model, 'membershipGrade')->textInput() ?>

    <?= $form->field($model, 'pushSex')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'toAge')->textInput() ?>

    <?= $form->field($model, 'fromAge')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton('确认推送',['class'=>'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
