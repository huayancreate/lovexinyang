<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrderDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-order-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'orderId') ?>

    <?= $form->field($model, 'goodsName') ?>

    <?= $form->field($model, 'goodsId') ?>

    <?= $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'totalPrice') ?>

    <?php // echo $form->field($model, 'rebate') ?>

    <?php // echo $form->field($model, 'rebatePrice') ?>

    <?php // echo $form->field($model, 'totalNum') ?>

    <?php // echo $form->field($model, 'sellerId') ?>

    <?php // echo $form->field($model, 'memberCardNo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
