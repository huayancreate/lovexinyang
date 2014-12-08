<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComGoodsReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-goods-review-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cgrId') ?>

    <?= $form->field($model, 'goodsId') ?>

    <?= $form->field($model, 'goodsName') ?>

    <?= $form->field($model, 'applyerId') ?>

    <?= $form->field($model, 'applyerAccount') ?>

    <?php // echo $form->field($model, 'applyTime') ?>

    <?php // echo $form->field($model, 'reviewerId') ?>

    <?php // echo $form->field($model, 'reviewerName') ?>

    <?php // echo $form->field($model, 'reviewTaskId') ?>

    <?php // echo $form->field($model, 'reviewTime') ?>

    <?php // echo $form->field($model, 'reviewStatus') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
