<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoSellerInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-seller-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customerManager') ?>

    <?= $form->field($model, 'contractId') ?>

    <?= $form->field($model, 'otherContactWay') ?>

    <?= $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'sellerName') ?>

    <?php // echo $form->field($model, 'sellerdetails') ?>

    <?php // echo $form->field($model, 'validity') ?>

    <?php // echo $form->field($model, 'contacts') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'accountBalance') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
