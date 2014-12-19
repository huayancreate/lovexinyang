<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-county-update">


    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'countyUpdateForm']); ?>

    <?php $mCity->cityCenterName=$cityCenterId;?>
   
    <?=$form->field($mCity,'cityCenterName')->dropDownList(ArrayHelper::map($mCitys,'id','cityCenterName')) ?>

    <?= $form->field($model, 'countyName')->textInput(['maxlength' => 200]) ?>

	<?= $form->field($model, 'isValid')->checkbox() ?>


<div class="col-lg-offset-5">

    <div class="form-group">
        <?= Html::button('更新', ['class' => 'btn btn-primary','id'=>'btnUpdate','onclick'=>"updateCounty($model->countyId)"]) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>


</div>

<script type="text/javascript">

	function updateCounty(countyId){
	        $.ajax({
	        	type:"POST",
	        	url:"index.php?r=com-county/update&id="+countyId,
	        	data:$('#countyUpdateForm').serialize(),
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
	 }
	 
</script>
