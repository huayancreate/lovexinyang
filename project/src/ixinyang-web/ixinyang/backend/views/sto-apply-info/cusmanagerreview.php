<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use cliff363825\kindeditor\KindEditorWidget;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $model backend\models\StoApplyInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-apply-info-cusmanagerreview">
    <?php 
        $form = ActiveForm::begin([
            'layout'=> 'horizontal',
                'id'=>'cusManagerReviewForm',
            ]); 
    ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>

            <?= $form->field($model, 'phone')->textInput() ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

            <?= $form->field($model, 'otherContact')->textInput(['maxlength' => 50]) ?>

            <?= $form->field($model, 'storeName')->textInput(['maxlength' => 250]) ?>

        </div>
    </div>

    <div class="row" id="dropDiv">
        <div class="col-lg-12">
            <div class="col-xs-4">
                <?php $mCity->cityCenterName=$model->city;  ?>
                <?= $form->field($mCity, 'cityCenterName')->dropDownList(ArrayHelper::map($citys, 'id', 'cityCenterName'), ['prompt' => '--城市--']) ?>
            </div>
            <div class="col-xs-4">
                <?php $mCounty->countyName=$model->regional;?>
                <?= $form->field($mCounty, 'countyName')->dropDownList(ArrayHelper::map($mCountys,'countyId','countyName'), ['prompt' => '--区域--']) ?>
            </div>
            <div class="col-xs-4">
                <?php $mBusidist->businessDistrictName=$model->businessZone ?>
                <?= $form->field($mBusidist, 'businessDistrictName')->dropDownList(ArrayHelper::map($mBusidists,'businessDistrictId','businessDistrictName'), ['prompt' => '--商圈--']) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'address')->textArea(['maxlength' => 250]) ?>

            <div class="col-lg-offset-4">
                <div class="form-group">
                    <!-- <?= Html::button('在地图上标注', ['class' => 'btn btn-warning', 'id' => 'map_button']) ?> -->
                    <label id="loglat" style="margin-left:5px;color:red;"></label>
                </div>
            </div>

            <?= $form->field($model, 'storePhone')->textInput() ?>

            <?= $form->field($model, 'daySales')->textInput() ?>

            <div class="form-group field-stoapplyinfo-storecategoryid required">
                <label class="control-label col-sm-3" for="storeCategoryId">商家类型</label>
                
                <div class="col-sm-6" style="position: relative">
                    <input type="text" id="storeCategoryId" value=<?php echo !empty($category) ?  "'". $category->categoryName."'" : "''"  ?>  onclick="showMenu()" class="form-control">

                    <div id="menuContent" class="menuContent"
                         style="display:none; position:absolute;z-index:1;width: 80%;">
                        <ul id="treeDemo" class="ztree" style="width:100%;height:300px"></ul>
                    </div>
                    <?= $form->field($model, 'storeCategoryId')->hiddenInput()->label(false) ?>
                    <!--                        <div class="help-block help-block-error "></div>-->

                </div>
            </div>

            <?= $form->field($model, 'scopeBusiness')->widget(\cliff363825\kindeditor\KindEditorWidget::className(), [
                'clientOptions' => [
                    'width' => '680px',
                    'height' => '380px',
                    'themeType' => 'default',
                    'itemType' => 'full',
                    'langType' => 'zh_CN',
                    'autoHeightMode' => true,
                    'allowImageUpload' => true,
                    'filePostName' => 'fileData',
                    //'uploadJson' => Url::to(['upload']),
                ],
            ]);
            ?>

            <div class="col-lg-offset-5">
                <div class="form-group">
                    <?= $form->field($model, 'applyStatus')->hiddenInput()->label(false) ?>
                    <?= $form->field($model, 'applyId')->hiddenInput()->label(false) ?>


                <?= Html::button('审核通过', ['class' => 'btn btn-success','id'=>'btnCheckPass','onclick'=>"checkPass(3,".$model->applyId.")"]) ?>
                    <?= Html::button('审核驳回', ['class' => 'btn btn-primary','id'=>'btnCheckFail','onclick'=>"checkFail()"]) ?>
                </div>
            </div>

            <!-- 驳回备注  点击驳回按钮出现-->
            <div class="row" id="remarkDiv" style="display:none" >
             <div class="col-lg-12">
                <div col-xs-3>
                 <?= $form->field($model, 'remark')->textArea() ?>
                </div>
                <div col-xs-3>
                  <?= Html::button('确定', ['class' => 'btn btn-success','id'=>'btnSave','onclick'=>"saveRejectRemark(4,".$model->applyId.")"]) ?>
                </div>
             </div>
            </div>


            <?= $form->field($model, 'longitude')->hiddenInput()->label('') ?>
            <?= $form->field($model, 'latitude')->hiddenInput()->label('') ?>

        </div>
    </div>

    <div id="menuContent" class="menuContent" style="display:none; position: absolute;">
        <ul id="treeDemo" class="ztree" style="margin-top:0; width:180px; height: 300px;"></ul>
    </div>
    <?php ActiveForm::end(); ?>
</div>


<?php
Dialog::begin([
    'id' => 'mapDiaLog',
    'clientOptions' => ['modal' => true, 'autoOpen' => false],]);
?>

<?php
Dialog::end();
?>
<script>
    $(document).ready(function(){
         //使文本框 下拉框 文本域 
         $('input,select,textarea',$('form[id="cusManagerReviewForm"]')).attr('readonly',true);
         //下拉框给设置只读却还可以选择  单独给它disabled
         $('select',$('form[id="cusManagerReviewForm"]')).attr('disabled',true);
    });

    //审核通过
    function checkPass(applyStatus,applyId){
        $.ajax({
            type: "POST",
            data: {'applyStatus': applyStatus,'applyId':applyId},
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

    //审核驳回   审核通过和审核驳回按钮都不可用
    function checkFail(applyStatus,applyId){
        $("#remarkDiv").show();
        $("#stoapplyinfo-remark").attr("readonly",false);
        $("#btnCheckPass").attr("disabled",true);
        $("#btnCheckFail").attr("disabled",true);
       
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