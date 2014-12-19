<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\DetailView;
use backend\models\ComCityCenter;
use backend\models\ComCounty;
use backend\models\ComBusinessDistrict;

?>
<div class="sto-apply-info-cusmanagerreview">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone',
            'email',
            'otherContact',
            'storeName',
            [
                'label'=>'城市',
                'value'=>ComCityCenter::findOne($model->city)->cityCenterName,
            ],

            [
                'label'=>'区域',
                'value'=>ComCounty::findOne($model->regional)->countyName,
            ],
            [
                'label' => '商圈',
                'value' => ComBusinessDistrict::findOne($model->businessZone)->businessDistrictName,
            ],
            'address',
            'storePhone',
            'daySales',
            [
                 'label'=>'商家类型',
                 'value'=> !empty($category) ? $category->categoryName : '',
            ],
            'scopeBusiness',
           
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
                    <?= $form->field($model, 'applyStatus')->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'applyId')->hiddenInput()->label(false) ?>


                <?= Html::button('审核通过', ['class' => 'btn btn-success','id'=>'btnCheckPass','onclick'=>"checkPass()"]) ?>
                    <?= Html::button('审核驳回', ['class' => 'btn btn-primary','id'=>'btnCheckFail','onclick'=>"checkFail()"]) ?>
                </div>
            </div>
            
            <!-- 商家信息补全 点击审核通过出现-->
            <div class="row" id="sellerInfoDiv" style="display:none" >
                
                    
                     <div class="form-group required">
                        <div class="col-lg-5">
                            <label class="control-label col-sm-3" >商家名称</label>
                            <div class="col-sm-8">
                               <input id="sellerName" class="form-control" type="text" maxlength="150" name="sellerName">
                            </div>
                        </div>
                     <div>
                     <div class="col-lg-5">
                            <label class="control-label col-sm-3">法人</label>
                            <div class="col-sm-8">
                              <input id="owner" class="form-control" type="text" maxlength="50" name="owner">
                            </div>
                    </div>
                    
                      <?= Html::button('确定', ['class' => 'btn btn-success','id'=>'btnSave','onclick'=>"saveSellerInfo(3,".$model->applyId.")"]) ?>
                   
                
            </div>

            <!-- 驳回备注  点击驳回按钮出现-->
            <div class="row" id="remarkDiv" style="display:none" >
             <div class="col-lg-12">
                <div class="col-xs-7">
                 <?= $form->field($model, 'remark')->textArea() ?>
                </div>
                
                  <?= Html::button('确定', ['class' => 'btn btn-success','id'=>'btnSave','onclick'=>"saveRejectRemark(4,".$model->applyId.")"]) ?>
               
             </div>
            </div>
      <?php ActiveForm::end(); ?>
</div>

<script>

    //审核通过
    function checkPass(){
        $("#sellerInfoDiv").show();
        $("#btnCheckPass").attr("disabled",true);
        $("#btnCheckFail").attr("disabled",true);
       
    }

    //审核驳回   审核通过和审核驳回按钮都不可用
    function checkFail(applyStatus,applyId){
        $("#remarkDiv").show();
        $("#stoapplyinfo-remark").attr("readonly",false);
        $("#btnCheckPass").attr("disabled",true);
        $("#btnCheckFail").attr("disabled",true);
       
    }
    //保存商家信息
    function saveSellerInfo(applyStatus,applyId){
        //商家名称
        var sellerName=$("#sellerName").val();
        //法人
        var owner=$("#owner").val();

         $.ajax({
            type: "POST",
            data: {'sellerName':sellerName,'owner':owner,'applyStatus': applyStatus,'applyId':applyId},
            url: "index.php?r=sto-apply-info%2Fcheckpass",
            dataType: "json",
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                if(data.success){
                    //当成功后操作。。
                   
                    //$.pjax.reload({container:'#discusstasksGrid'});

                    //操作成功跳转到商家信息和账号信息以及门店信息录入界面
                    //商家id   data.sellerId
                    //门店id   data.storeInfoId
                     alert("商家id :"+data.sellerId+" 门店id:"+data.storeInfoId);

                }else{
                    alert("操作失败原因："+data.errormsg+",请重试.");
                }
            }
        });


    }
    //保存驳回备注
    function saveRejectRemark(applyStatus,applyId)
    {
        //驳回备注
        var remark=$("#stoapplyinfo-remark").val();

         $.ajax({
            type: "POST",
            data: {'remark':remark,'applyStatus': applyStatus,'applyId':applyId},
            url: "index.php?r=sto-apply-info%2Fcheckfail",
            dataType: "json",
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                if(data==1){
                    //当成功后操作。。
                    alert("操作成功.");
                    $.pjax.reload({container:'#discusstasksGrid'});
                }else{
                    alert("操作失败，请重试.");
                }
            }
        });
    }


</script>
