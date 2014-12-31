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
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">商家信息</h3>
                  </div>
                  <div class="panel-body">
                          <div class="col-lg-6">
                            <label class="control-label col-sm-4" >商家名称</label>
                            <div class="col-sm-8">
                               <input id="sellerName" class="form-control" type="text" maxlength="150" name="sellerName">
                            </div>
                         </div>
                         <div>
                             <div class="col-lg-6">
                                <label class="control-label col-sm-4">法人</label>
                                <div class="col-sm-8">
                                  <input id="owner" class="form-control" type="text" maxlength="50" name="owner">
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">支付信息</h3>
                  </div>
                  <div class="panel-body">
                        <div class="col-lg-6">
                            <label class="control-label col-sm-4" >支付宝名称</label>
                            <div class="col-sm-8">
                               <input id="alipayName" class="form-control" type="text" maxlength="150" name="alipayName">
                            </div>
                         </div>
                         <div>
                             <div class="col-lg-6">
                                <label class="control-label col-sm-4">支付宝账号</label>
                                <div class="col-sm-8">
                                  <input id="alipayNo" class="form-control" type="text" maxlength="40" name="alipayNo">
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
                 <div class="col-lg-offset-10">
                    <div class="form-group">
                    <?= Html::button('确定', ['class' => 'btn btn-success','id'=>'btnSave','onclick'=>"saveSellerInfo(3,".$model->applyId.")"]) ?>
                  </div>
               </div>
            </div>

            <!-- 驳回备注  点击驳回按钮出现-->
            <div class="row" id="remarkDiv" style="display:none" >
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">驳回备注</h3>
                  </div>
                  <div class="panel-body">
                       <div class="col-lg-12">
                        <div class="col-xs-7">
                         <?= $form->field($model, 'remark')->textArea() ?>
                        </div>
                        <?= Html::button('确定', ['class' => 'btn btn-success','onclick'=>"saveRejectRemark(4,".$model->applyId.")"]) ?>  
                     </div>
                  </div>
                </div>
            </div>

         <?php ActiveForm::end(); ?>
           

<script type="text/javascript">

    //审核通过
    function checkPass(){
       if(confirm("确定审核通过吗？")){
            $("#sellerInfoDiv").show();
            $("#btnCheckPass").attr("disabled",true);
            $("#btnCheckFail").attr("disabled",true);
        }
       
    }

    //审核驳回   审核通过和审核驳回按钮都不可用
    function checkFail(applyStatus,applyId){
       if(confirm("确定审核驳回吗？")){
          $("#remarkDiv").show();
          $("#stoapplyinfo-remark").attr("readonly",false);
          $("#btnCheckPass").attr("disabled",true);
          $("#btnCheckFail").attr("disabled",true);
      }
       
    }
    //保存商家信息
    function saveSellerInfo(applyStatus,applyId){
       if(confirm("确定审核通过吗？")){
         //商家信息
            //商家名称
            var sellerName=$("#sellerName").val();
            //法人
            var owner=$("#owner").val();
        //支付信息
           //支付宝名称
           var alipayName=$("#alipayName").val();
           //支付宝账号
           var alipayNo=$("#alipayNo").val();
           //以上四个信息 任何一个为空都不给提交弹出提示框
            if(sellerName=="" || owner=="" || alipayName=="" || alipayNo==""){
              
              alert("商家信息和支付信息都是必填的,请填完整哦");
              return false;
            }
            else{

                 $.ajax({
                  type: "POST",
                  data: {'sellerName':sellerName,'owner':owner,'alipayName':alipayName,'alipayNo':alipayNo,'applyStatus': applyStatus,'applyId':applyId},
                  url: "index.php?r=sto-apply-info%2Fcheckpass",
                  dataType: "json",
                  error: function (request) {
                      alert("Connection error");
                  },
                  success: function (data) {
                      if(data.success){
                          //当成功后操作。。
                          alert("操作成功");
                          $.pjax.reload({container:'#discusstasksGrid'});

                      }else{
                          alert("操作失败原因："+data.errormsg+",请重试.");
                      }
                  }
                });
           }
       }
    }
    //保存驳回备注
    function saveRejectRemark(applyStatus,applyId)
    {
      if(confirm("确定审核驳回吗？")){
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
    }


</script>
