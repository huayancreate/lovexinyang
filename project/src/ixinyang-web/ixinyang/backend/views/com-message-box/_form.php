<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComMessageBox */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-message-box-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'seeDate')->textInput() ?>

    <?= $form->field($model, 'sendOutDate')->textInput() ?>

    <?= $form->field($model, 'recipientsId')->textInput() ?>

    <?= $form->field($model, 'recipientsName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'readState')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'content')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
