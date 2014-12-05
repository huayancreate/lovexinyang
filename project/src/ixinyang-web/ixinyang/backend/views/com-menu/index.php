<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use backend\models\ComMenu;
use backend\controllers\ComMenuController;
use yii\jui\Dialog;

$this->title = 'Com Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-menu-index">

    <div class="row">
 <div class="col-lg-5">
    <?php 
    echo "所有菜单信息</br>";
     ?>
    <?php 
    //给变量赋值
    @$isValidDropStr='3';

    ?>
    <?php echo "是否有效";
     ?>
    <select id="isValidDrop"  onchange="isValidDropFunction()" >
      <option value="2" <?php if ($isValid == '2') echo 'selected'; ?>>全部</option>
      <option value="1" <?php if ($isValid == '1') echo 'selected'; ?>>是</option>
      <option value="0" <?php if ($isValid == '0') echo 'selected'; ?>>否</option>
    </select>
     
     <?php   
      @$rootModel=ComMenu::find()->where(['id'=>'1'])->one();
     ?>
  <?= $rootModel->menuName ?><input type="button" class="btn btn-success" id="add_<?=$rootModel->id ?>" name="add_<?=$rootModel->id ?>" value="添加" onclick="addFunction(<?=$rootModel->id ?>)">
   

        <?php
        //查询所有有效的一级菜单  2-->全部  1-->有效   0-->无效
        if ($isValid!=2) {
          @$firstLevelModels=ComMenu::find()->where(['isValid'=>$isValid,'parentMenuId'=>'1'])->all();
        }
        else
        {
          @$firstLevelModels=ComMenu::find()->where(['parentMenuId'=>'1'])->all();
        }
        ?>
        <?php if (count($firstLevelModels)>0): ?>
    <ul>
        <?php foreach ($firstLevelModels as $firstLevelModel): ?>

      <li>
         <?= $firstLevelModel->menuName ?>
          <input type="button" class="btn btn-success" id="add_<?=$firstLevelModel->id ?>" name="add_<?=$firstLevelModel->id ?>" value="添加" onclick="addFunction(<?=$firstLevelModel->id ?>)"> 
         
         <input type="submit" class="btn btn-primary" id="update_<?=$firstLevelModel->id ?>" name="update_<?=$firstLevelModel->id ?>" value="修改" onclick="updateFunction(<?=$firstLevelModel->id ?>)">
         
       <!--  <input type="submit" id="delete_<?=$firstLevelModel->id ?>" name="delete_<?=$firstLevelModel->id ?>" data-confirm="Are you sure you want to delete this item?" data-method="post" value="删除" onclick="deleteFunction(<?=$firstLevelModel->id ?>)">-->
         <?php if ($firstLevelModel->isValid==1) {?>
             <?= Html::a('删除', ['delete', 'id' =>$firstLevelModel->id,'isValid'=>$isValid], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '确定删除该菜单吗?',
                    'method' => 'post',
                ],               
               ]) ?>   
         <?php }  else { ?>
              <?= Html::a('删除', ['delete', 'id' =>$firstLevelModel->id,'isValid'=>$isValid], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '确定删除该菜单吗?',
                    'method' => 'post',
                ],
                'disabled'=>true,
               ])  ?>          
         <?php }   ?>
         


           <?php 
             //查询一级菜单下的所有二级菜单
               if ($isValid!=2) {
                  @$secondLevelModels=ComMenu::find()->where(['isValid'=>$isValid,'parentMenuId'=>$firstLevelModel->id])->all();  
               }
               else
               {
                 @$secondLevelModels=ComMenu::find()->where(['parentMenuId'=>$firstLevelModel->id])->all();  
               }
           ?>
              
             <?php  if (count($secondLevelModels)>0):  ?>

                  <?php foreach ($secondLevelModels as $secondLevelModel): ?>
            
                    <ul>
                        <li><?= $secondLevelModel->menuName ?>
                             <input type="button" class="btn btn-primary" id="update_<?=$secondLevelModel->id ?>" name="update_<?=$secondLevelModel->id ?>" value="修改" onclick="updateFunction(<?=$secondLevelModel->id ?>)">
                             <!--<input type="button" id="delete_<?=$secondLevelModel->id ?>" name="delete_<?=$secondLevelModel->id ?>" value="删除">-->
                            
                            <?php if ($secondLevelModel->isValid==1) {?>
                                  <?= Html::a('删除', ['delete', 'id' =>$secondLevelModel->id,'isValid'=>$isValid], [
                                       'class' => 'btn btn-danger',
                                       'data' => [
                                            'confirm' => '确定删除该菜单吗?',
                                            'method' => 'post',
                                       ],
                                 ]) ?>
                            <?php }  else { ?>
                                  <?= Html::a('删除', ['delete', 'id' =>$secondLevelModel->id,'isValid'=>$isValid], [
                                       'class' => 'btn btn-danger',
                                       'data' => [
                                            'confirm' => '确定删除该菜单吗?',
                                            'method' => 'post',
                                       ],
                                       'disabled'=>true,
                                 ]) ?>
                            <?php }   ?>
                        </li>
                    </ul>
                  <?php endforeach; ?>

               <?php endif; ?>     
        </li>
        <?php endforeach; ?>
      </ul>
        <?php endif; ?>
 
 </div>



</div>
    

</div>

<script type="text/javascript">

function addFunction(id)
{
  var isValidDropStr=$("#isValidDrop").val();
  getLoadInfo(id,isValidDropStr);
  $("#dialogId").dialog("open");
        $("#dialogId").dialog({
                autoOpen:false,
                modal: true, 
                width: 450,
                height:250,
                title:"添加信息",
                show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                hide: "explode",       //hide:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                resizable: true,
                overlay: {
                    opacity: 0.5,
                    background: "black",
                    overflow: 'auto'
                },
            buttons: {
              /*"submit": function(){
                add(id,isValidDropStr);
              },
              Cancel: function() {
                $("#dialogId").dialog( "close" );
              }*/
            },
            close: function () {
                $("#formtest input").val('');
                $("#dialogId").dialog("close");
            },  
          });
    
}
function getLoadInfo(id,isValidDropStr){
     $.ajax({
         type:"post",
         url:"index.php?r=com-menu%2Freload&id="+id+"&isValid="+isValidDropStr,
         success:function(data) {
            $("#addOrUpdateMenuDiv").html(data);
         }
       });
}

function getUpdateInfo(id,isValidDropStr){
     $.ajax({
         type:"post",
         url:"index.php?r=com-menu%2Fupdate&id="+id+"&isValid="+isValidDropStr,
         success:function(data) {
            $("#addOrUpdateMenuDiv").html(data);
         }
       });
}

 function add(id,isValidDropStr){
      var menuNameStr=$("#menuName").val();
      var menuUrlStr=$("#menuUrl").val();
      var parentMenuIdHdnStr=id;
        $.ajax({
         type:"post",
         data:"",
         url:"index.php?r=com-menu%2Fcreate&id="+id+"&isValid="+isValidDropStr+"&menuName="+menuNameStr+"&menuUrl="+menuUrlStr+"&parentMenuIdHdn="+parentMenuIdHdnStr,
         success:function(data) {
            $("#dialogId").dialog("close");
         }
       });
  }

function updateFunction(id)
{
  $isValidDropStr=$("#isValidDrop").val();
  getUpdateInfo(id,$isValidDropStr);
  $("#dialogId").dialog("open");
        $("#dialogId").dialog({
                autoOpen:false,
                modal: true, 
                width: 450,
                height:250,
                title:"修改信息",
                show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                hide: "explode",       //hide:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                resizable: true,
                overlay: {
                    opacity: 0.5,
                    background: "black",
                    overflow: 'auto'
                },
            buttons: {
              /*"submit": function(){
                add(id,isValidDropStr);
              },
              Cancel: function() {
                $("#dialogId").dialog( "close" );
              }*/
            },
            close: function () {
                $("#formtest input").val('');
                $("#dialogId").dialog("close");
            },  
          });
}

function isValidDropFunction()
{
  $isValidDropStr=$("#isValidDrop").val();
  location.href="/ixinyang-web/ixinyang/backend/web/index.php?r=com-menu%2Findex&isValid="+$isValidDropStr;
}
</script>

 <?php 
      Dialog::begin([
      'id'=>'dialogId',
      'clientOptions' => [
      'modal' => true,
      'autoOpen' => false,
      ],]);


  ?>    
<div id="addOrUpdateMenuDiv" >
</div>

<?php
    Dialog::end();
?>