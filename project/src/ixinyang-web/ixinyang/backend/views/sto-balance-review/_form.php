<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoBalanceReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-balance-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'financeId')->textInput() ?>

    <?= $form->field($model, 'financeAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'financeReviewStatus')->textInput() ?>

    <?= $form->field($model, 'reviewId')->textInput() ?>

    <?= $form->field($model, 'reviewAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'reviewTime')->textInput() ?>

    <?= $form->field($model, 'reviewStatus')->textInput() ?>

    <?= $form->field($model, 'serviceFee')->textInput() ?>

    <?= $form->field($model, 'serviceAgreement')->textInput() ?>

    <?= $form->field($model, 'balanceEndTime')->textInput() ?>

    <?= $form->field($model, 'balanceStartTime')->textInput() ?>

    <?= $form->field($model, 'storeId')->textInput() ?>

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'applyerId')->textInput() ?>

    <?= $form->field($model, 'applyerAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'applyMoney')->textInput() ?>

    <?= $form->field($model, 'actualBalanceMoney')->textInput() ?>

    <?= $form->field($model, 'financeReviewTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
