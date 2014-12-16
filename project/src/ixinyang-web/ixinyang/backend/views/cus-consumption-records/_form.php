<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusConsumptionRecords */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-consumption-records-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orderNo')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'orderId')->textInput() ?>

    <?= $form->field($model, 'goodsId')->textInput() ?>

    <?= $form->field($model, 'verfificationCode')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'goodsNumber')->textInput() ?>

    <?= $form->field($model, 'costPrice')->textInput() ?>

    <?= $form->field($model, 'payablePrice')->textInput() ?>

    <?= $form->field($model, 'rebate')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'userAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'memberCardNo')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sellerId')->textInput() ?>

    <?= $form->field($model, 'sellerAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'verifierAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'verifierTime')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
