<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCategoryMaintainSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-category-maintain-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'parentCategoryId') ?>

    <?= $form->field($model, 'categoryAttribute') ?>

    <?= $form->field($model, 'categoryFeature') ?>

    <?= $form->field($model, 'categoryCode') ?>

    <?php // echo $form->field($model, 'categoryGrade') ?>

    <?php // echo $form->field($model, 'categoryName') ?>

    <?php // echo $form->field($model, 'categoryType') ?>

    <?php // echo $form->field($model, 'operatorId') ?>

    <?php // echo $form->field($model, 'operatorName') ?>

    <?php // echo $form->field($model, 'updateTime') ?>

    <?php // echo $form->field($model, 'isValid') ?>

    <?php // echo $form->field($model, 'sort') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
