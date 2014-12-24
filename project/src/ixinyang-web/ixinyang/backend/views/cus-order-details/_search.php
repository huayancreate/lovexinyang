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

    <?php echo "<b>��֤�룺</b>".$form->field($model, 'validateCode') ?>

    <?php // echo $form->field($model, 'CodeStatus') ?>

    <div class="form-group">
        <?= Html::submitButton('��ѯ', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('ȷ������', ['id'=>'btnSave','class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
