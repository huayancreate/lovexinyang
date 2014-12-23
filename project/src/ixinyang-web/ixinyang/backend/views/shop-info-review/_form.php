<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use cliff363825\kindeditor\KindEditorWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="shop-info-review-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'shopinforeviewFrom']); ?>
    <!--��������-->
    <?= $form->field($model, 'shopName')->textInput(['maxlength' => 50]) ?>
    <!--��ϵ��ʽ-->
    <?= $form->field($model, 'contact')->textInput(['maxlength' => 50]) ?>
    <!--����-->   
    <?php $cityModel->cityCenterName=$model->cityId;  ?>
    <?= $form->field($cityModel, 'cityCenterName')->dropDownList(ArrayHelper::map($cityList, 'id', 'cityCenterName'), ['prompt' => '--����--']) ?>
    <input type="hidden" id="cityId" name="ShopInfoReview[cityId]" value=<?= $model->cityId?>> 
    <!--����-->
    <?= $form->field($model, 'countyId')->dropDownList(['prompt' => '--����--']) ?>
    <input type="hidden" id="countyId" value=<?= $model->countyId?>> 
    <!--��Ȧ-->
    <?= $form->field($model, 'businessDistrictId')->dropDownList(['prompt' => '--��Ȧ--']) ?>
    <input type="hidden" id="businessDistrictId" value=<?= $model->businessDistrictId?>>
    <!--��ϸ��ַ-->
    <?= $form->field($model, 'address')->textInput(['maxlength' => 250]) ?>
    <!--Ӫҵʱ��-->
    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 100]) ?>
    <!--�ŵ����-->
    <?= 
        $form->field($model, 'storeOutline')->widget(KindEditorWidget::className(), [ 
            'clientOptions' => [ 
            'width' => '400', 
            'height' => 'auto', 
            'themeType' => 'default', 
            'itemType' => 'full', 
            'langType' => 'zh_CN', 
            'autoHeightMode' => true, 
            'filePostName' => 'fileData', 
            //'uploadJson' => Url::to(['upload']), 
            'uploadJson'=>Yii::$app->urlManager->createUrl(['upload']),
            ], 
        ]); 
    ?> 
    <!--��ͼ����-->
    <?= $form->field($model, 'longitude')->textInput() ?>
    <!--��ͼγ��-->
    <?= $form->field($model, 'latitude')->textInput() ?>
    
    <!-- <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript"> 

//��ȡ����
function getCountry(cityId) {
    $.ajax({
        type: "get",
        data: {'cityId': cityId},
        url: "index.php?r=shopinforeview%2Fcounty",
        dataType: "json",
        success: function (data) {
            $("#shopinforeview-countyid").empty();
            $("#shopinforeview-countyid").append("<option value='0'>-" + "-����-" + "-</option>");
            jQuery.each(data, function (idx, item) {
                if($("#countyId").val()===item.countyId){
                    $("#shopinforeview-countyid").append("<option value='" + item.countyId + "'selected>" + item.countyName + "</option>");
                }
                $("#shopinforeview-countyid").append("<option value='" + item.countyId + "'>" + item.countyName + "</option>");
            });
        }
    });
}

    //��ȡ��Ȧ
function getBusiness(countyId) {
    $.ajax({
        type: "get",
        data: {'countyId': countyId},
        url: "index.php?r=shopinforeview%2Fbusiness",
        dataType: "json",
        success: function (business) {
            $("#shopinforeview-businessdistrictid").empty();
            $("#shopinforeview-businessdistrictid").append("<option value='0'>-" + "-��Ȧ-" + "-</option>");
            jQuery.each(business, function (idx, item) {
                if($("#businessDistrictId").val()===item.businessDistrictId){
                    $("#shopinforeview-businessdistrictid").append("<option value='" + item.businessDistrictId + "'selected>" + item.businessDistrictName + "</option>");
                }
                $("#shopinforeview-businessdistrictid").append("<option value='" + item.businessDistrictId + "'>" + item.businessDistrictName + "</option>");
            });
        }
    });
}

$(function(){
    //ͨ����ɸѡ����
    $("#comcitycenter-citycentername").change(function(){
        $("#cityId").val($(this).val());
        getCountry($(this).val());
    });

    //ͨ������ɸѡ����
    $("#shopinforeview-countyid").change(function(){
        getBusiness($(this).val());
    });

    getCountry($("#cityId").val());
    getBusiness($("#countyId").val());
});

    
</script>