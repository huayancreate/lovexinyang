<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComGoodsReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-goods-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goodsId')->textInput() ?>

    <?= $form->field($model, 'goodsName')->textInput(['maxlength' => 300]) ?>

    <?= $form->field($model, 'applyerId')->textInput() ?>

    <?= $form->field($model, 'applyerAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'applyTime')->textInput() ?>

    <?= $form->field($model, 'reviewerId')->textInput() ?>

    <?= $form->field($model, 'reviewerName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'reviewTaskId')->textInput() ?>

    <?= $form->field($model, 'reviewTime')->textInput() ?>

    <?= $form->field($model, 'reviewStatus')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
