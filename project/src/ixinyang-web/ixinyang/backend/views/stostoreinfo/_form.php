<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\StoStoreInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sto-store-info-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'stostoreinfoFrom']); ?>

  <!--   <?= $form->field($model, 'createTime')->textInput() ?> -->

    <?= $form->field($model, 'storeAddress')->textInput(['maxlength' => 150]) ?>
    
    <!--店铺类别-->
    <!-- <?php $categoryModel->categoryName=$model->storeType;  ?>
    <?= $form->field($categoryModel, 'categoryName')->dropDownList(
        ArrayHelper::map($categoryList, 'id', 'categoryName'),
        ['prompt' => '--店铺类别--'])->label('店铺类别') ?> -->
        
    <div style="position: relative">
        <?= $form->field($categoryModel, 'categoryName')->textInput(['id' => 'parentCategoryId', 'value' => $category->categoryName,'readonly'=>true]) ?>
        <div id="menuContent" class="menuContent" style="display:none; position:absolute;z-index:1;width: 80%;">
            <ul id="treeDemo" class="ztree" style="width:100%;height:300px"></ul>
        </div>
    </div>

    <!-- <input type="hidden" id="storeType" name="StoStoreInfo[storeType]" value=<?= $model->storeType ?>>  -->
    <?= $form->field($model, 'storeType')->hiddenInput(['id' => 'hiddenCategoryId'])->label(false) ?>

    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'contactWay')->textInput(['maxlength' => 50]) ?>

<!--     <?= $form->field($model, 'sellerId')->textInput() ?>

    <?= $form->field($model, 'validity')->textInput(['maxlength' => 2]) ?> -->

    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 150]) ?>

     <div class="col-lg-offset-4">
        <div class="form-group">
            <?= Html::button('在地图上标注', ['class' => 'btn btn-warning', 'id' => 'map_button']) ?>
            <label id="loglat" style="margin-left:5px;color:red;"></label>
        </div>
    </div>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => 100,'readonly'=>true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => 100,'readonly'=>true]) ?>

    <!-- <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div> -->

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript"> 

$(function(){
    $("#comcategorymaintain-categoryname").change(function(){
        var storeType=$("#comcategorymaintain-categoryname").val();
        $("#storeType").val(storeType);
    });

    <!--地图调用-->
    var mapUrl = '<?php echo Yii::$app->urlManager->baseUrl.'/map.html'?>';
    jQuery.showMap('map_button', mapUrl, 'stostoreinfo-longitude', 'stostoreinfo-latitude');
});

function beforeClick(treeId, treeNode) {
        //var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        //zTree.expandNode(treeNode);
    }

    function onClick(e, treeId, treeNode) {
        //alert(treeNode.categoryName + "----" + treeNode.id);
        $("#parentCategoryId").val(treeNode.categoryName);
        $("#hiddenCategoryId").val(treeNode.id);
        //getCategoryGrade(treeNode.id);
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

    
</script>

<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/zTreeStyle.css', []);
?>