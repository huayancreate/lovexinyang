<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'goodsName') ?>

   <!--  <?= $form->field($model, 'summary') ?>

    <?= $form->field($model, 'describes') ?> -->

    <?= $form->field($model, 'price') ?>

    <?= $form->field($model, 'subClass') ?>

    <?php // echo $form->field($model, 'validity') ?>

    <?php // echo $form->field($model, 'supplyDateTime') ?>

    <?php // echo $form->field($model, 'enjoyRebate') ?>

    <?php // echo $form->field($model, 'goodsGrade') ?>

    <?php // echo $form->field($model, 'goodsWeight') ?>

    <?php // echo $form->field($model, 'goodsState') ?>

    <?php // echo $form->field($model, 'createDate') ?>

    <?php // echo $form->field($model, 'createID') ?>

    <?php // echo $form->field($model, 'createName') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
