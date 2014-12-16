<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-refund-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'financeId')->textInput() ?>

    <?= $form->field($model, 'financeAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'financeReviewTime')->textInput() ?>

    <?= $form->field($model, 'financeReviewStatus')->textInput() ?>

    <?= $form->field($model, 'reviewId')->textInput() ?>

    <?= $form->field($model, 'reviewAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'reviewTime')->textInput() ?>

    <?= $form->field($model, 'reviewStatus')->textInput() ?>

    <?= $form->field($model, 'orderId')->textInput() ?>

    <?= $form->field($model, 'orderName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'busiName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'busiId')->textInput() ?>

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'storeId')->textInput() ?>

    <?= $form->field($model, 'applyTime')->textInput() ?>

    <?= $form->field($model, 'refundMoney')->textInput() ?>

    <?= $form->field($model, 'refundReason')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'verificationCode')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'userName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'userAccount')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
