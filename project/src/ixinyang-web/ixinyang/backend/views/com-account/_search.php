<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComAccountSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-account-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'createTime') ?>

    <?= $form->field($model, 'phoneNumber') ?>

    <?= $form->field($model, 'updateTime') ?>

    <?php // echo $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'nickname') ?>

    <?php // echo $form->field($model, 'userName') ?>

    <?php // echo $form->field($model, 'accountStatus') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'isFirstLogin') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
