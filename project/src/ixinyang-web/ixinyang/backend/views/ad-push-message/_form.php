<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdPushMessage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-push-message-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'toAge')->textInput() ?>

    <?= $form->field($model, 'fromAge')->textInput() ?>

    <?= $form->field($model, 'isValid')->textInput(['maxlength' => 1]) ?>

    <?= $form->field($model, 'pushIntroduction')->textInput() ?>

    <?= $form->field($model, 'pushTime')->textInput() ?>

    <?= $form->field($model, 'pushDetails')->textInput() ?>

    <?= $form->field($model, 'pushSex')->textInput(['maxlength' => 4]) ?>

    <?= $form->field($model, 'messageTopic')->textInput() ?>

    <?= $form->field($model, 'membershipGrade')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
