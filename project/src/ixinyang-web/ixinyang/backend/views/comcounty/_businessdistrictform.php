
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComBusinessDistrict */
/* @var $form ActiveForm */
?>
<div class="comcounty-_businessdistrictadd">
 
     <?php $form2 = ActiveForm::begin(['layout' => 'horizontal']); ?>

       <?php $model->countyName=$countyId;?>
    	 <?=$form2->field($model,'countyName')->dropDownList(ArrayHelper::map($models,'countyId','countyName')) ?>
 	 
       <?=$form2->field($ComBusinessDistrict,'businessDistrictCode')->textInput() ?>
  
       <?=$form2->field($ComBusinessDistrict,'businessDistrictName')->textInput(['maxlength' => 200]) ?>
 
   <div class="col-lg-offset-5">
    <div class="form-group">
     <?= Html::submitButton($ComBusinessDistrict->isNewRecord ? '保存' : '更新', ['class' => $ComBusinessDistrict->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
   </div>

    <?php ActiveForm::end(); ?>
 
</div><!-- comcounty-_combusinessdistrictform -->
