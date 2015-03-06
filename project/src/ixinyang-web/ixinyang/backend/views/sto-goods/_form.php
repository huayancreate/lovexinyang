<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
use cliff363825\kindeditor\KindEditorWidget;
use kartik\widgets\FileInput;
use yii\web\Url;
use kartik\markdown\MarkdownEditor;
use backend\models\GoodsPicture;
use backend\models\FileUpload;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sto-goods-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'goodsFrom',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model,'file[]')->widget(
        FileInput::className(),[

            'options'=>[
                'multiple' => true,
            ],
            'pluginOptions'=>[
                'initialPreview'=>GoodsPicture::getPicture($model->id),
                'previewFileType' => 'any',
                'showUpload'=>false,
                'browseLabel'=>'浏览文件',
                'removeLabel'=>'移除文件',
                'initialCaption'=>"请选择上传文件，多个文件请全选",
                'overwriteInitial'=>false,
                'maxFileSize'=>1024*1024*2,//单位 是 KB
                'showCaption' => true,
                'showRemove' => true,
                'maxFileCount' => 4,
            ],

        ])->label("选择图片")?>

    <?= $form->field($model, 'goodsName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'summary')->textarea() ?>

    <?= 
        $form->field($model, 'describes')->widget(KindEditorWidget::className(), [ 
            'model' => $model,
            'attribute' => 'describes',
            'clientOptions' => [ 
                'model'=>$model,
                'width' => '450', 
                'height' => 'auto', 
                'themeType' => 'default', 
                'itemType' => 'full', 
                'langType' => 'zh_CN', 
                'autoHeightMode' => true, 
                'filePostName' => 'describes', 
                'uploadJson' => yii\helpers\Url::to(['upload']), 
            ], 
        ]); 
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

   
    <div style="position: relative">
        <?= $form->field($categoryModel, 'categoryName')->textInput(['id' => 'parentCategoryId', 'value' => $category->categoryName]) ?>
        <div id="menuContent" class="menuContent" style="display:none; position:absolute;z-index:1;width: 80%;">
            <ul id="treeDemo" class="ztree" style="width:100%;height:300px"></ul>
        </div>
    </div>
    <?= $form->field($model, 'subClass')->hiddenInput(['id' => 'hiddenCategoryId'])->label(false) ?>
     
    <?= $form->field($model, 'validity')->checkbox() ?>

    <?= $form->field($model, 'supplyDateTime')->textInput() ?>

    <?= $form->field($goodsStoreModel, 'inventory')->textInput() ?>

    <?= $form->field($goodsStoreModel, 'enjoyRebate')->checkbox() ?>
    
    <?= $form->field($goodsStoreModel, 'goodsState')->hiddenInput(['id'=>'hiddenGoodsState','name'=>'hiddenGoodsState'])->label(false)?>


    <div class="line-height" style="text-align:right;margin:16px;">
        <?= Html::submitButton($model->isNewRecord ? '草稿保存' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'btnSave']) ?>
       <?php if($model->isNewRecord){ ?>
            <?= Html::submitButton( '发布'  , ['class' => 'btn btn-success' ,'id'=>'btnPublish']) ?>
       <?php }?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(function(){
        //草稿保存
        $("#btnSave").click(function(){
            //草稿保存   商品状态：0：待发布、1已发布、2已下架
            $("#hiddenGoodsState").val(0);
        });

        //发布
        $("#btnPublish").click(function(){
            //草稿保存   商品状态：0：待发布、1已发布、2已下架
            $("#hiddenGoodsState").val(1);
        });

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

</script>
<style type="text/css">
.line-height{
    line-height:40px;
  }
</style>