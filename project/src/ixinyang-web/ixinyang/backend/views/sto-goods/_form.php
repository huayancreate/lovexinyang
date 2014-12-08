<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goodsName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'describes')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'subClass')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'validity')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'supplyDateTime')->textInput() ?>

    <?= $form->field($model, 'enjoyRebate')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'goodsGrade')->textInput() ?>

    <?= $form->field($model, 'goodsWeight')->textInput() ?>

    <?= $form->field($model, 'goodsState')->textInput() ?>

    <?= $form->field($model, 'createDate')->textInput() ?>

    <?= $form->field($model, 'createID')->textInput() ?>

    <?= $form->field($model, 'createName')->textInput(['maxlength' => 30]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
