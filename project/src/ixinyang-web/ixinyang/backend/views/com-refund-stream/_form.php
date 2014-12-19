<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundStream */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-refund-stream-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'operatorId')->textInput() ?>

    <?= $form->field($model, 'operatorAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'operateTime')->textInput() ?>

    <?= $form->field($model, 'loadTime')->textInput() ?>

    <?= $form->field($model, 'loadAlipayName')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'loadAlipayAccount')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'refundMoney')->textInput() ?>

    <?= $form->field($model, 'refundStreamId')->textInput() ?>

    <?= $form->field($model, 'refundTime')->textInput() ?>

    <?= $form->field($model, 'refundApplyId')->textInput() ?>

    <?= $form->field($model, 'refundApplyTime')->textInput() ?>

    <?= $form->field($model, 'verificationCode')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'userAccount')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'payAlipayName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'payAlipayAccount')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'alipayStreamNumber')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
