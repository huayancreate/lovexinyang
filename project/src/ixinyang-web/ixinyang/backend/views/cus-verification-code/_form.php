<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusVerificationCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-verification-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orderDetailsId')->textInput() ?>

    <?= $form->field($model, 'verificationCode')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'goodsId')->textInput() ?>

    <?= $form->field($model, 'orderNo')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

    <?= $form->field($model, 'costPrice')->textInput() ?>

    <?= $form->field($model, 'payablePrice')->textInput() ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
