<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdRecommendGoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-recommend-goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'creater') ?>

    <?= $form->field($model, 'createTime') ?>

    <?= $form->field($model, 'adLocation') ?>

    <?= $form->field($model, 'endDate') ?>

    <?php // echo $form->field($model, 'startDate') ?>

    <?php // echo $form->field($model, 'ad_recommend_goods') ?>

    <?php // echo $form->field($model, 'isValid') ?>

    <?php // echo $form->field($model, 'ad_advertisement') ?>

    <?php // echo $form->field($model, 'order') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
