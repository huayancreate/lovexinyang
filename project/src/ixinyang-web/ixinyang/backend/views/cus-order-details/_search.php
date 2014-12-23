<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrderDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cus-order-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'inline',
    ]); ?>

    <!--<?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'orderId') ?>

    <?= $form->field($model, 'goodsName') ?>

    <?= $form->field($model, 'goodsId') ?>

    <?= $form->field($model, 'price') ?>-->

    <?php // echo $form->field($model, 'totalPrice') ?>

    <?php // echo $form->field($model, 'rebate') ?>

    <?php // echo $form->field($model, 'rebatePrice') ?>

    <?php // echo $form->field($model, 'totalNum') ?>

    <?php // echo $form->field($model, 'sellerId') ?>

    <?php // echo $form->field($model, 'memberCardNo') ?>

    <?php // echo $form->field($model, 'shopId') ?>

    <?php // echo $form->field($model, 'shopName') ?>

    <?php echo "<b>验证码：</b>".$form->field($model, 'validateCode') ?>

    <?php // echo $form->field($model, 'CodeStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('查询', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('确认消费', ['id'=>'btnSave','class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
