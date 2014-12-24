<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComMessageBoxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-message-box-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'seeDate') ?>

    <?= $form->field($model, 'sendOutDate') ?>

    <?= $form->field($model, 'recipientsId') ?>

    <?= $form->field($model, 'recipientsName') ?>

    <?php // echo $form->field($model, 'readState') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'title') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
