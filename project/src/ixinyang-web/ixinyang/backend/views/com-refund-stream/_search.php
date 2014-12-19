<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundStreamSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-refund-stream-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'operatorId') ?>

    <?= $form->field($model, 'operatorAccount') ?>

    <?= $form->field($model, 'operateTime') ?>

    <?= $form->field($model, 'loadTime') ?>

    <?php // echo $form->field($model, 'loadAlipayName') ?>

    <?php // echo $form->field($model, 'loadAlipayAccount') ?>

    <?php // echo $form->field($model, 'refundMoney') ?>

    <?php // echo $form->field($model, 'refundStreamId') ?>

    <?php // echo $form->field($model, 'refundTime') ?>

    <?php // echo $form->field($model, 'refundApplyId') ?>

    <?php // echo $form->field($model, 'refundApplyTime') ?>

    <?php // echo $form->field($model, 'verificationCode') ?>

    <?php // echo $form->field($model, 'userId') ?>

    <?php // echo $form->field($model, 'userAccount') ?>

    <?php // echo $form->field($model, 'payAlipayName') ?>

    <?php // echo $form->field($model, 'payAlipayAccount') ?>

    <?php // echo $form->field($model, 'alipayStreamNumber') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
