<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use cliff363825\kindeditor\KindEditorWidget;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="shop-info-review-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'shopinforeviewFrom']); ?>
    <!--店铺名称-->
    <?= $form->field($model, 'shopName')->textInput(['maxlength' => 50]) ?>
    <!--店铺类别-->
  <!--   <?= $form->field($categoryModel, 'categoryName')->dropDownList(
      ArrayHelper::map($categoryList, 'id', 'categoryName'),
      ['prompt' => '--店铺类别--'])->label('店铺类别') ?> -->
    <div style="position: relative">
        <?= $form->field($categoryModel, 'categoryName')->textInput(['id' => 'parentCategoryId', 'value' => $category->categoryName]) ?>
        <div id="menuContent" class="menuContent" style="display:none; position:absolute;z-index:1;width: 80%;">
            <ul id="treeDemo" class="ztree" style="width:100%;height:300px"></ul>
        </div>
    </div>
    <?= $form->field($model, 'storeType')->hiddenInput(['id' => 'hiddenCategoryId'])->label(false) ?>
    <!--支付宝名称-->
    <?= $form->field($model,'alipayName')->textInput(['maxlength'=>150]) ?>
    <!--支付宝账号-->
    <?= $form->field($model,'alipayNo')->textInput(['maxlength'=>40]) ?>
    <!--联系方式-->
    <?= $form->field($model, 'contact')->textInput(['maxlength' => 50]) ?>
    <!--城市-->   
    <?php $cityModel->cityCenterName=$model->cityId;  ?>
    <?= $form->field($cityModel, 'cityCenterName')->dropDownList(ArrayHelper::map($cityList, 'id', 'cityCenterName'), ['prompt' => '--城市--']) ?>
    <input type="hidden" id="cityId" name="ShopInfoReview[cityId]" value=<?= $model->cityId?>> 
    <!--区域-->
    <?= $form->field($model, 'countyId')->dropDownList(['prompt' => '--区域--']) ?>
    <input type="hidden" id="countyId" value=<?= $model->countyId?>> 
    <!--商圈-->
    <?= $form->field($model, 'businessDistrictId')->dropDownList(['prompt' => '--商圈--']) ?>
    <input type="hidden" id="businessDistrictId" value=<?= $model->businessDistrictId?>>
    <!--详细地址-->
    <?= $form->field($model, 'address')->textArea(['maxlength' => 250]) ?>
    <!--营业时间-->
    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 100]) ?>
    <!--门店概述-->
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
     <div class="col-lg-offset-4">
        <div class="form-group">
            <?= Html::button('在地图上标注', ['class' => 'btn btn-warning', 'id' => 'map_button']) ?>
            <label id="loglat" style="margin-left:5px;color:red;"></label>
        </div>
    </div>
    <!--地图经度-->
    <?= $form->field($model, 'longitude')->textInput(['readonly'=>true]) ?>
    <!--地图纬度-->
    <?= $form->field($model, 'latitude')->textInput(['readonly'=>true]) ?>
    
    <!-- <div class="form-group">
     <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
     </div>  --> 

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript"> 

//获取区域
function getCountry(cityId) {
    $.ajax({
        type: "get",
        data: {'cityId': cityId},
        url: "index.php?r=shopinforeview%2Fcounty",
        dataType: "json",
        success: function (data) {
            $("#shopinforeview-countyid").empty();
            $("#shopinforeview-countyid").append("<option value='0'>-" + "-区域-" + "-</option>");
            jQuery.each(data, function (idx, item) {
                if($("#countyId").val()===item.countyId){
                    $("#shopinforeview-countyid").append("<option value='" + item.countyId + "'selected>" + item.countyName + "</option>");
                }
                $("#shopinforeview-countyid").append("<option value='" + item.countyId + "'>" + item.countyName + "</option>");
            });
        }
    });
}

    //获取商圈
function getBusiness(countyId) {
    $.ajax({
        type: "get",
        data: {'countyId': countyId},
        url: "index.php?r=shopinforeview%2Fbusiness",
        dataType: "json",
        success: function (business) {
            $("#shopinforeview-businessdistrictid").empty();
            $("#shopinforeview-businessdistrictid").append("<option value='0'>-" + "-商圈-" + "-</option>");
            jQuery.each(business, function (idx, item) {
                if($("#businessDistrictId").val()===item.businessDistrictId){
                    $("#shopinforeview-businessdistrictid").append("<option value='" + item.businessDistrictId + "'selected>" + item.businessDistrictName + "</option>");
                }
                $("#shopinforeview-businessdistrictid").append("<option value='" + item.businessDistrictId + "'>" + item.businessDistrictName + "</option>");
            });
        }
    });
}

 function beforeClick(treeId, treeNode) {
        //var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        //zTree.expandNode(treeNode);
    }

    function onClick(e, treeId, treeNode) {
        //alert(treeNode.categoryName + "----" + treeNode.id);
        $("#parentCategoryId").val(treeNode.categoryName);
        $("#hiddenCategoryId").val(treeNode.id);
        getCategoryGrade(treeNode.id);
        $("#menuContent").fadeOut("fast");
    }

    $("#parentCategoryId").bind("click", function () {
        $("#menuContent").css("display", "block");
        $("body").bind("mousedown", onBodyDown);
    });

    function hideMenu() {
        $("#menuContent").fadeOut("fast");
        $("body").unbind("mousedown", onBodyDown);
    }
    function onBodyDown(event) {
        if (!(event.target.id == "menuBtn" || event.target.id == "parentCategoryId" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length > 0)) {
            hideMenu();
        }
    }
    $(function () {
        BindTree();
    });

    function BindTree() {
        var setting = {
            view: {
                dblClickExpand: false
            },
            async: {
                enable: true,
                url: "index.php?r=com-category-maintain/category&type=1"
            },
            data: {
                key: {name: "categoryName"},
                simpleData: {
                    enable: true,
                    idKey: "id",
                    pIdKey: "parentCategoryId"
                }
            },
            callback: {
                beforeClick: beforeClick,
                onClick: onClick
            }
        };
        $.fn.zTree.init($("#treeDemo"), setting);
    }

    function getCategoryGrade(id) {
        $.post("index.php?r=com-category-maintain/grade", {id: id}, function (data) {
            $("#hiddenGrade").val(parseInt(data) + 1);
        });
    }

$(function(){
    //通过市筛选区县
    $("#comcitycenter-citycentername").change(function(){
        $("#cityId").val($(this).val());
        getCountry($(this).val());
    });

    //通过区县筛选区域
    $("#shopinforeview-countyid").change(function(){
        getBusiness($(this).val());
    });

    getCountry($("#cityId").val());
    getBusiness($("#countyId").val());

    <!--地图调用-->
    var mapUrl = '<?php echo Yii::$app->urlManager->baseUrl.'/map.html'?>';
    jQuery.showMap('map_button', mapUrl, 'shopinforeview-longitude', 'shopinforeview-latitude');
   
});

    
</script>

<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/zTreeStyle.css', []);
?>