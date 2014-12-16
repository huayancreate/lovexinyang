<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoBalanceReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-balance-review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'financeId') ?>

    <?= $form->field($model, 'financeAccount') ?>

    <?= $form->field($model, 'financeReviewStatus') ?>

    <?= $form->field($model, 'reviewId') ?>

    <?php // echo $form->field($model, 'reviewAccount') ?>

    <?php // echo $form->field($model, 'reviewTime') ?>

    <?php // echo $form->field($model, 'reviewStatus') ?>

    <?php // echo $form->field($model, 'serviceFee') ?>

    <?php // echo $form->field($model, 'serviceAgreement') ?>

    <?php // echo $form->field($model, 'balanceEndTime') ?>

    <?php // echo $form->field($model, 'balanceStartTime') ?>

    <?php // echo $form->field($model, 'storeId') ?>

    <?php // echo $form->field($model, 'storeName') ?>

    <?php // echo $form->field($model, 'applyerId') ?>

    <?php // echo $form->field($model, 'applyerAccount') ?>

    <?php // echo $form->field($model, 'applyMoney') ?>

    <?php // echo $form->field($model, 'actualBalanceMoney') ?>

    <?php // echo $form->field($model, 'financeReviewTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
