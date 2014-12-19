<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusConsumptionRecordsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-consumption-records-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'orderNo') ?>

    <?= $form->field($model, 'orderId') ?>

    <?= $form->field($model, 'goodsId') ?>

    <?= $form->field($model, 'verfificationCode') ?>

    <?php // echo $form->field($model, 'goodsNumber') ?>

    <?php // echo $form->field($model, 'costPrice') ?>

    <?php // echo $form->field($model, 'payablePrice') ?>

    <?php // echo $form->field($model, 'rebate') ?>

    <?php // echo $form->field($model, 'userAccount') ?>

    <?php // echo $form->field($model, 'memberCardNo') ?>

    <?php // echo $form->field($model, 'sellerId') ?>

    <?php // echo $form->field($model, 'sellerAccount') ?>

    <?php // echo $form->field($model, 'verifierAccount') ?>

    <?php // echo $form->field($model, 'verifierTime') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
