<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoSellerInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-seller-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customerManager')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'contractId')->textInput() ?>

    <?= $form->field($model, 'otherContactWay')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'sellerName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'validity')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'contacts')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'accountBalance')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
