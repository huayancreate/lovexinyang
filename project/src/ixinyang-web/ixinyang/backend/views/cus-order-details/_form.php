<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrderDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-order-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orderId')->textInput() ?>

    <?= $form->field($model, 'goodsName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'goodsId')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'totalPrice')->textInput() ?>

    <?= $form->field($model, 'rebate')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'rebatePrice')->textInput() ?>

    <?= $form->field($model, 'totalNum')->textInput() ?>

    <?= $form->field($model, 'sellerId')->textInput() ?>

    <?= $form->field($model, 'memberCardNo')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
