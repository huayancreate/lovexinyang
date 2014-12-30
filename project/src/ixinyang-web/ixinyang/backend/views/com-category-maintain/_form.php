<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\ComCategoryMaintain */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-category-maintain-form">
    <?php $form = ActiveForm::begin(["id" => "categoryForm"]); ?>
    <?= $form->field($model, 'categoryName')->textInput(['maxlength' => 200, 'check-type' => 'required']) ?>
    <?= $form->field($model, 'categoryType')->dropDownList([
        '1' => '商品类别',
        '2' => '评价类别'
    ], ['id' => 'categoryType']) ?>
    <div style="position: relative">
        <?= $form->field($model, 'parentCategoryId')->textInput(['id' => 'parentCategoryId', 'value' => $category->categoryName]) ?>
        <div id="menuContent" class="menuContent" style="display:none; position:absolute;z-index:1;width: 80%;">
            <ul id="treeDemo" class="ztree" style="width:100%;height:300px"></ul>
        </div>
    </div>
    <?= $form->field($model, 'parentCategoryId')->hiddenInput(['id' => 'hiddenCategoryId'])->label(false) ?>
    <?= $form->field($model, 'categoryGrade')->hiddenInput(['id' => 'hiddenGrade', 'value' => $model->categoryGrade === null ? '0' : $model->categoryGrade])->label(false) ?>
    <?= $form->field($model, 'sort')->textInput(['check-type' => 'required']) ?>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(function () {
        $("form").validation();
    });
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
    $("#categoryType").bind("change", function () {
        BindTree();
    });
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
                url: "index.php?r=com-category-maintain/category&type=" + $("#categoryType").val()
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
</script>

