
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComBusinessDistrict */
/* @var $form ActiveForm */
?>
<div class="comcounty-_businessdistrictadd">
 
     <?php $form2 = ActiveForm::begin(['layout' => 'horizontal','id'=>'busidisAddForm']); ?>

       <?php $model->countyName=$ComBusinessDistrict->countyId;?>
    	 <?=$form2->field($model,'countyName')->dropDownList(ArrayHelper::map($models,'countyId','countyName')) ?>
 	 
      <!--  <?=$form2->field($ComBusinessDistrict,'businessDistrictCode')->textInput() ?> -->
  
       <?=$form2->field($ComBusinessDistrict,'businessDistrictName')->textInput(['maxlength' => 200]) ?>
 
       <?= $form2->field($ComBusinessDistrict, 'isValid')->checkbox() ?>

   <div class="col-lg-offset-5">
    <div class="form-group">
     <?= Html::button('保存', ['class' => 'btn btn-success','onclick'=>"busidisAdd($ComBusinessDistrict->countyId)"]) ?>
    </div>
   </div>

    <?php ActiveForm::end(); ?>
 
</div><!-- comcounty-_combusinessdistrictform -->

<script type="text/javascript">

  function busidisAdd(countyId){
          $.ajax({
            type:"POST",
            url:"index.php?r=com-county/businessdistrictadd&countyId="+countyId,
            data:$('#busidisAddForm').serialize(),
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
