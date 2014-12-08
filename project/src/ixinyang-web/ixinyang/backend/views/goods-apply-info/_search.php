<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsApplyInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-apply-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'shopId') ?>

    <?= $form->field($model, 'shopName') ?>

    <?= $form->field($model, 'stock') ?>

    <?= $form->field($model, 'enterId') ?>

    <?php // echo $form->field($model, 'enterAccount') ?>

    <?php // echo $form->field($model, 'storeId') ?>

    <?php // echo $form->field($model, 'storeName') ?>

    <?php // echo $form->field($model, 'supplyTime') ?>

    <?php // echo $form->field($model, 'goodsPrice') ?>

    <?php // echo $form->field($model, 'goodsIntroduction') ?>

    <?php // echo $form->field($model, 'goodsType') ?>

    <?php // echo $form->field($model, 'goodsDescription') ?>

    <?php // echo $form->field($model, 'goodsName') ?>

    <?php // echo $form->field($model, 'goodsValidityDate') ?>

    <?php // echo $form->field($model, 'goodsId') ?>

    <?php // echo $form->field($model, 'goodsStatus') ?>

    <?php // echo $form->field($model, 'memberDiscount') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
