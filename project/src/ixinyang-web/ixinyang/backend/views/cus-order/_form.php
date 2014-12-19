<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orderNo')->textInput() ?>

    <?= $form->field($model, 'totalPrice')->textInput() ?>

    <?= $form->field($model, 'userAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'userName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'payTotalPrice')->textInput() ?>

    <?= $form->field($model, 'buyTime')->textInput() ?>

    <?= $form->field($model, 'methodsPayment')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'paymentAccount')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
