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

<div class="sto-apply-info-form">
    <?php 
        $form = ActiveForm::begin([
            'layout'=> 'horizontal',
                'id'=>'applyinfoForm',
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
                    <?= Html::button('审核通过', ['class' => 'btn btn-success','id'=>'btnCheckPass','onclick'=>"checkPassOrFail(1,".$model->applyId.")"]) ?>
                    <?= Html::button('审核驳回', ['class' => 'btn btn-primary','id'=>'btnCheckFail','onclick'=>"checkPassOrFail(2,".$model->applyId.")"]) ?>
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

<!-- <div id="divMap">
    <div id="preview">
        <div id="float_search_bar">
            <label>区域：</label>
            <input type="text" id="keyword"/>
            <button id="search_button">查找</button>
            <span>点击地图或标注获取坐标</span>
        </div>
        <div id="map_container"></div>
    </div>
    <div id="result" style="margin-top: 4px;"></div>
    <label id="longitude" style="display:none"></label>
    <label id="latitude" style="display:none"></label>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=1.2"></script>
    <script src="/ixinyang-web/ixinyang/backend/web/map/map.js"></script>
</div> -->

<?php
Dialog::end();
?>
<script>
//这个页面用不到
/*$("#map_button").bind("click", function () {
        $("#mapDiaLog").dialog("open");
        $("#mapDiaLog").dialog({
            autoOpen: false,
            modal: true,
            width: 530,
            height: 460,
            title: "采集坐标",
            show: "blind",
            hide: "explode",
            resizable: true,
            overlay: {
                opacity: 0.5,
                background: "black",
                overflow: 'auto'
            }
        });
        $("#mapDiaLog").on("dialogbeforeclose", function (event, ui) {
            $("#loglat").text($("#result").text());
            $("#stoapplyinfo-longitude").val($("#longitude").text());
            $("#stoapplyinfo-latitude").val($("#latitude").text());
        });

    });


    //级联菜单
    $("#comcitycenter-citycentername").change(function () {
        var cityId = $(this).val();
        getCountry(cityId);
    });

    //获取区域
    function getCountry(cityId) {
        $.ajax({
            type: "POST",
            data: {'cityId': cityId},
            url: "index.php?r=sto-apply-info%2Fcountry",
            dataType: "json",
            success: function (countrys) {
                $("#comcounty-countyname").empty();
                $("#comcounty-countyname").append("<option value='0'>-" + "-区域-" + "-</option>");
                jQuery.each(countrys, function (idx, item) {
                    $("#comcounty-countyname").append("<option value='" + item.countyId + "'>" + item.countyName + "</option>");
                });
            }
        });
    }

    $("#comcounty-countyname").change(function () {
        var countryId = $(this).val();
        getBusiness(countryId);
    });
    //获取商圈
    function getBusiness(countryId) {
        $.ajax({
            type: "POST",
            data: {'countryId': countryId},
            url: "index.php?r=sto-apply-info%2Fbusiness",
            dataType: "json",
            success: function (business) {
                $("#combusinessdistrict-businessdistrictname").empty();
                $("#combusinessdistrict-businessdistrictname").append("<option value='0'>-" + "-商圈-" + "-</option>");
                $("#combusinessdistrict-businessdistrictname").css('width', "120");
                jQuery.each(business, function (idx, item) {
                    $("#combusinessdistrict-businessdistrictname").append("<option value='" + item.businessDistrictId + "'>" + item.businessDistrictName + "</option>");
                });
            }
        });
    }

    var setting = {
        view: {
            dblClickExpand: false
        },
        async: {
            enable: true,
            url: "index.php?r=sto-apply-info/category"
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
//            onAsyncSuccess: zTreeOnAsyncSuccess
        }
    };

    //    function zTreeOnAsyncSuccess(event, treeId, treeNode, msg) {
    //        var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
    //        var node = treeObj.getNodeByParam("id", "4", null);
    //        treeObj.selectNode(node.getParentNode());
    //    }

    function beforeClick(treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.expandNode(treeNode);
    }

    function onClick(e, treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
            nodes = zTree.getSelectedNodes(),
            id = "",
            v = "";

        if (!treeNode.isParent) {
            nodes.sort(function compare(a, b) {
                return a.id - b.id;
            });

            for (var i = 0, l = nodes.length; i < l; i++) {
                v += nodes[i].categoryName + ",";
                id += nodes[i].id + ",";
            }

            if (v.length > 0) v = v.substring(0, v.length - 1);
            var cityObj = $("#storeCategoryId");
            cityObj.attr("value", v);
            $("#stoapplyinfo-storecategoryid").attr("value", id);
            $("#menuContent").fadeOut("fast");
        }
    }

    function showMenu() {
        $("#menuContent").css("display", "block");
        $("body").bind("mousedown", onBodyDown);
    }

    $("#storeCategoryId").click(function () {
        showMenu();
    });

    function hideMenu() {
        $("#menuContent").fadeOut("fast");
        $("body").unbind("mousedown", onBodyDown);
    }
    function onBodyDown(event) {
        if (!(event.target.id == "menuBtn" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length > 0)) {
            hideMenu();
        }
    }

    $(document).ready(function () {
        $.fn.zTree.init($("#treeDemo"), setting);
    });
*/
    $(document).ready(function(){
         //使文本框 下拉框 文本域 
         $('input,select,textarea',$('form[id="applyinfoForm"]')).attr('readonly',true);
    });
    function checkPassOrFail(applyStatus,applyId){
        $.ajax({
            type: "POST",
            data: {'applyStatus': applyStatus,'applyId':applyId},
            url: "index.php?r=sto-apply-info%2Fupdate",
            dataType: "json",
            success: function (data) {
                if(data==1){
                    //当成功后操作。。
                    alert("操作成功.");
                    $.pjax.reload({container:'#stoapplyinfoGrid'});
                }else{
                    alert("操作失败，请重试.");
                }
            }
        });
    }


</script>