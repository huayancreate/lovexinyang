<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsApplyInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-apply-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'shopId')->textInput() ?>

    <?= $form->field($model, 'shopName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'stock')->textInput() ?>

    <?= $form->field($model, 'enterId')->textInput() ?>

    <?= $form->field($model, 'enterAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'storeId')->textInput() ?>

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'supplyTime')->textInput() ?>

    <?= $form->field($model, 'goodsPrice')->textInput() ?>

    <?= $form->field($model, 'goodsIntroduction')->textInput() ?>

    <?= $form->field($model, 'goodsType')->textInput() ?>

    <?= $form->field($model, 'goodsDescription')->textInput() ?>

    <?= $form->field($model, 'goodsName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'goodsValidityDate')->textInput() ?>

    <?= $form->field($model, 'goodsId')->textInput() ?>

    <?= $form->field($model, 'goodsStatus')->textInput() ?>

    <?= $form->field($model, 'memberDiscount')->textInput(['maxlength' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
