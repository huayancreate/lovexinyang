<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-refund-review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'financeId') ?>

    <?= $form->field($model, 'financeAccount') ?>

    <?= $form->field($model, 'financeReviewTime') ?>

    <?= $form->field($model, 'financeReviewStatus') ?>

    <?php // echo $form->field($model, 'reviewId') ?>

    <?php // echo $form->field($model, 'reviewAccount') ?>

    <?php // echo $form->field($model, 'reviewTime') ?>

    <?php // echo $form->field($model, 'reviewStatus') ?>

    <?php // echo $form->field($model, 'orderId') ?>

    <?php // echo $form->field($model, 'orderName') ?>

    <?php // echo $form->field($model, 'busiName') ?>

    <?php // echo $form->field($model, 'busiId') ?>

    <?php // echo $form->field($model, 'storeName') ?>

    <?php // echo $form->field($model, 'storeId') ?>

    <?php // echo $form->field($model, 'applyTime') ?>

    <?php // echo $form->field($model, 'refundMoney') ?>

    <?php // echo $form->field($model, 'refundReason') ?>

    <?php // echo $form->field($model, 'verificationCode') ?>

    <?php // echo $form->field($model, 'userName') ?>

    <?php // echo $form->field($model, 'userAccount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
