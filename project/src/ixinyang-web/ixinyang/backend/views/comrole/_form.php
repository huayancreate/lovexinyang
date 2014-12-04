<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use backend\assets\AppAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\com_role */
/* @var $form yii\widgets\ActiveForm */
?>
<table style="width:100%">
    <tr>
        <td valign="top">
            <!--角色新增-->
            <div class="com-role-form">
                <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'roleForm']); ?>

                <?= $form->field($model, 'roleCode')->textInput() ?>

                <?= $form->field($model, 'roleName')->textInput(['maxlength' => 50]) ?>

                <?= $form->field($model, 'isValid')->checkbox() ?>

                <input type="hidden" name="menuId" id="menuId">

                <?php ActiveForm::end(); ?>

            </div>
        </td>
        <td valign="top">
            <ul id="treeDemo" class="ztree"></ul>
        </td>
    </tr>
</table>

<div style="border-top:1px solid #ccc;padding-top:10px; text-align:right">
    <?= Html::button($model->isNewRecord ? '新增' : '修改', 
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
            'id'=>$model->isNewRecord ? 'btnSave' : 'btnEdit']) ?>
    <?= Html::button('取消',['id'=>'btnClose','class'=>'btn btn-primary']) ?>
</div>

<script type="text/javascript">

    function dialogClose(){
        $("#dialogId").dialog("close");
    }

    //树形菜单配置
    var setting = {
        check: {
            enable: true  //显示checbox
        },
        view: {
            showIcon: showIconForTree //是否显示树形菜单图标
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        callback:{
            onCheck:onCheck
        }
    };            

    //获取选中项ID
    function onCheck(e,treeId,treeNode){
        var treeObj=$.fn.zTree.getZTreeObj("treeDemo"),
        nodes=treeObj.getCheckedNodes(true);
            
        var id="";
        var arrayObj = new Array();
        for(var i=0;i<nodes.length;i++){
            id+= nodes[i].id+",";
        }
        $("#menuId").val(id);
    }

    //是否显示树形菜单图标
     function showIconForTree(treeId, treeNode) {
        return treeNode.isParent;
    };

    //生成树形菜单
    function ztree(jsonData){
        $.fn.zTree.init($("#treeDemo"), setting, jsonData);
        //展开全部树节点
        // var treeObj = $.fn.zTree.getZTreeObj("treeDemo"); 
        // treeObj.expandAll(true); 
    }

    //ajax提交
    function postAjax(url){
            $.ajax({
                cache: true,
                url:url,
                data:$("#roleForm").serialize(),
                type :'post',
                async: false, 
                dataType:"json",  
                success : function(data) {
                    if(data.success){
                        dialogClose();
                        $.pjax.reload({container:'#w1'});
                    }else{
                        alert(data.roleName+'\n'+data.roleCode);
                    }
                },  
                error : function(data) {  
                    alert("异常错误,请联系管理员!");  
                }
            });
    }

    $(function(){
        //加载树开始
        ztree(<?=$treeData?>);

        $("#btnClose").click(function(){
            dialogClose();
        });

        //编辑
        $("#btnEdit").click(function(){
            var url="index.php?r=comrole/update&id=<?= $model->isNewRecord?"0":$model->id ?>";
            postAjax(url);
        });

        //新增提交
        $("#btnSave").click(function(){
            var url="index.php?r=comrole/create";
            postAjax(url);
        });
    });
    
</script>
