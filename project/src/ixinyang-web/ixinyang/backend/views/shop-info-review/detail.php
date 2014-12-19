<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use backend\models\ComBusinessDistrict;
use backend\models\ComCityCenter;
use backend\models\ComCounty;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */

?>
<div class="shop-info-review-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'shopName',
            'contact',
            [
                'label'=>'城市',
                'value'=>ComCityCenter::findOne($model->cityId)->cityCenterName,
            ],
            [
                'label' => '区县',
                'value' => ComCounty::findOne($model->countyId)->countyName,
            ],
            [
                'label' => '商圈',
                'value' => ComBusinessDistrict::findOne($model->businessDistrictId)->businessDistrictName,
            ],
            'address',
            'businessHours',
            'storeOutline:ntext',
            'longitude',
            'latitude',
        ],
    ]) ?>


     <?php 
            $form = ActiveForm::begin([
                'layout'=> 'horizontal',
                    'id'=>'cusManagerReviewForm',
                ]); 
     ?>
            <div class="col-lg-offset-8">
                <div class="form-group">
                <?= Html::button('审核通过', ['class' => 'btn btn-success','id'=>'btnCheckPass','onclick'=>"checkPass(4,".$model->id.")"]) ?>
                    <?= Html::button('审核驳回', ['class' => 'btn btn-primary','id'=>'btnCheckFail','onclick'=>"checkFail()"]) ?>
                </div>
            </div>
            
          

            <!-- 驳回备注  点击驳回按钮出现-->
            <div class="row" id="remarkDiv" style="display:none" >
             <div class="col-lg-12">
                <div class="col-xs-7">
                 <?= $form->field($model, 'Rejection')->textArea() ?>
                </div>
                
                  <?= Html::button('确定', ['class' => 'btn btn-success','id'=>'btnSave','onclick'=>"saveRejectRemark(5,".$model->id.")"]) ?>
               
             </div>
            </div>
      <?php ActiveForm::end(); ?>

</div>

<script>

    //审核通过
    function checkPass(auditState,id){
        $.ajax({
            type: "POST",
            data: {'auditState': auditState,'id':id},
            url: "index.php?r=shop-info-review%2Fcheckpass",
            dataType: "json",
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                if(data.success){
                    //当成功后操作。。
                alert("操作成功");
                $.pjax.reload({container:'#shopinforeviewlistGrid'});
                    
                     

                }else{
                    alert("操作失败原因："+data.errormsg+",请重试.");
                }
            }
        });
       
    }

    //审核驳回   审核通过和审核驳回按钮都不可用
    function checkFail(){
        $("#remarkDiv").show();
        $("#btnCheckPass").attr("disabled",true);
        $("#btnCheckFail").attr("disabled",true);
       
    }
  
    //保存驳回备注
    function saveRejectRemark(auditState,id)
    {
        //驳回备注
        var rejection=$("#shopinforeview-rejection").val();

         $.ajax({
            type: "POST",
            data: {'rejection':rejection,'auditState': auditState,'id':id},
            url: "index.php?r=shop-info-review%2Fcheckfail",
            dataType: "json",
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                if(data==1){
                    //当成功后操作。。
                    alert("操作成功.");
                    $.pjax.reload({container:'#shopinforeviewlistGrid'});
                }else{
                    alert("操作失败，请重试.");
                }
            }
        });
    }


</script>
