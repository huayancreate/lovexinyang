<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-county-create">


    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'createForm']); ?>

	<?=$form->field($mCity,'cityCenterName')->dropDownList(ArrayHelper::map($mCitys,'id','cityCenterName')) ?>

    <?= $form->field($model, 'countyName')->textInput(['maxlength' => 200]) ?>
	
	<?= $form->field($model, 'isValid')->checkbox() ?>
<div class="col-lg-offset-5">

    <div class="form-group">
      
       <?= Html::button("保存",['id'=>'btnSave','class' =>'btn btn-success']) ?>
    </div>
</div>
<!-- <div style="text-align:right;border-top:1px solid #ccc; padding-top:10px;">
	<?= Html::button("保存",['id'=>'btnSave','class' =>'btn btn-success']) ?>
	<?= Html::button("取消",['id'=>'btnClose','class' =>'btn btn-success']) ?>
</div> -->
    <?php ActiveForm::end(); ?>


</div>
<script type="text/javascript">

	$("#btnSave").click(function(){
	        $.ajax({
	        	type:"POST",
	        	url:"index.php?r=com-county/create",
	        	data:$('#createForm').serialize(),
	        	dataType:'json',
	        error: function (request) {
	            alert("Connection error");
	        },
	        success:function(data) {
	        	if(data.success){
	        		//当成功后操作。。
	        		alert('操作成功.');
	        		$.pjax.reload({container:'#countyGrid'});
	        	}else{
	        		alert(data.countyName+'\n'+data.cityCenterId);
	        	}
	        }
	    });
	}); 
</script>
