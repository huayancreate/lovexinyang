<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\StoStoreInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-store-info-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'stostoreinfoFrom']); ?>

  <!--   <?= $form->field($model, 'createTime')->textInput() ?> -->

    <?= $form->field($model, 'storeAddress')->textInput(['maxlength' => 150]) ?>
    
    <!--店铺类别-->
    <?php $categoryModel->categoryName=$model->storeType;  ?>
    <?= $form->field($categoryModel, 'categoryName')->dropDownList(
        ArrayHelper::map($categoryList, 'id', 'categoryName'),
        ['prompt' => '--店铺类别--'])->label('店铺类别') ?>
        
    <input type="hidden" id="storeType" name="StoStoreInfo[storeType]" value=<?= $model->storeType ?>> 

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'contactWay')->textInput(['maxlength' => 50]) ?>

<!--     <?= $form->field($model, 'sellerId')->textInput() ?>

    <?= $form->field($model, 'validity')->textInput(['maxlength' => 2]) ?> -->

    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 100]) ?>

    <!-- <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript"> 

$(function(){
    $("#comcategorymaintain-categoryname").change(function(){
        var storeType=$("#comcategorymaintain-categoryname").val();
        $("#storeType").val(storeType);
    });
});
    
</script>
