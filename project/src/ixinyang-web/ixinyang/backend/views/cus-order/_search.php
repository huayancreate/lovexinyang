<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'orderNo') ?>

    <?= $form->field($model, 'totalPrice') ?>

    <?= $form->field($model, 'userAccount') ?>

    <?= $form->field($model, 'userName') ?>

    <?php // echo $form->field($model, 'payTotalPrice') ?>

    <?php // echo $form->field($model, 'buyTime') ?>

    <?php // echo $form->field($model, 'methodsPayment') ?>

    <?php // echo $form->field($model, 'paymentAccount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
