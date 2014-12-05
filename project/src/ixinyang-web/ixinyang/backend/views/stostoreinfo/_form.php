<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoStoreInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-store-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'createTime')->textInput() ?>

    <?= $form->field($model, 'storeAddress')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'storeType')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'contactWay')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sellerId')->textInput() ?>

    <?= $form->field($model, 'validity')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
