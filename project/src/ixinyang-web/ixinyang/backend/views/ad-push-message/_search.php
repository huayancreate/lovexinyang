<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdPushMessageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-push-message-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'toAge') ?>

    <?= $form->field($model, 'fromAge') ?>

    <?= $form->field($model, 'isValid') ?>

    <?php // echo $form->field($model, 'pushIntroduction') ?>

    <?php // echo $form->field($model, 'pushTime') ?>

    <?php // echo $form->field($model, 'pushDetails') ?>

    <?php // echo $form->field($model, 'pushSex') ?>

    <?php // echo $form->field($model, 'messageTopic') ?>

    <?php // echo $form->field($model, 'membershipGrade') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
