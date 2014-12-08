
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComBusinessDistrict */
/* @var $form ActiveForm */
?>
<div class="comcounty-_businessdistrictupdate">
 
     <?php $form2 = ActiveForm::begin(['layout' => 'horizontal','id'=>'busidisUpdateForm']); ?>

       <?php $model->countyName=$ComBusinessDistrict->countyId;?>
    	 <?=$form2->field($model,'countyName')->dropDownList(ArrayHelper::map($models,'countyId','countyName')) ?>
 	 
       <!-- <?=$form2->field($ComBusinessDistrict,'businessDistrictCode')->textInput() ?> -->
  
       <?=$form2->field($ComBusinessDistrict,'businessDistrictName')->textInput(['maxlength' => 200]) ?>
 	
 	   <?= $form2->field($ComBusinessDistrict, 'isValid')->checkbox() ?>

   <div class="col-lg-offset-5">
    <div class="form-group">
     <?= Html::button('更新', ['class' => 'btn btn-primary','onclick'=>"busidisUpdate($ComBusinessDistrict->businessDistrictId)"]) ?>
    </div>
   </div>

    <?php ActiveForm::end(); ?>
 
</div><!-- comcounty-_combusinessdistrictform -->

<script type="text/javascript">

	function busidisUpdate(busdisId){
	        $.ajax({
	        	type:"POST",
	        	url:"index.php?r=com-county/businessdistrictupdate&businessDistrictId="+busdisId,
	        	data:$('#busidisUpdateForm').serialize(),
	        	dataType:'json',
	        error: function (request) {
	            alert("Connection error");
	        },
	        success:function(data) {
	        	if(data.success){
	        		//当成功后操作。。
	        		alert('操作成功.');
	        		$.pjax.reload({container:'#busidessGrid'});
	        	}else{
	        		alert(data.businessDistrictName);
	        	}
	        }
	    });
	 }
	 
</script>

