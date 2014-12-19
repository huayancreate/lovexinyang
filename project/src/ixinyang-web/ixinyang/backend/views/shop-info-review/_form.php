<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-info-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'shopName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'contact')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'regional')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'storeId')->textInput() ?>

    <?= $form->field($model, 'storeAccount')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'businessDistrictId')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'storeOutline')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cityId')->textInput() ?>

    <?= $form->field($model, 'countyId')->textInput() ?>

    <?= $form->field($model, 'applyTime')->textInput() ?>

    <?= $form->field($model, 'applyUserId')->textInput() ?>

    <?= $form->field($model, 'applyUserName')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'auditUserId')->textInput() ?>

    <?= $form->field($model, 'auditUserName')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'auditTime')->textInput() ?>

    <?= $form->field($model, 'managerId')->textInput() ?>

    <?= $form->field($model, 'managerName')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'managerTime')->textInput() ?>

    <?= $form->field($model, 'auditState')->textInput() ?>

    <?= $form->field($model, 'Rejection')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
