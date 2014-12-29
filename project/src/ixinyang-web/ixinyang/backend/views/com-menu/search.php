  <?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use backend\models\ComMenu;
use backend\controllers\ComMenuController;
use yii\jui\Dialog;
?>


 
 <div class="com-menu-search">
     <div class="line-height">
         <?php   
          @$rootModel=ComMenu::find()->where(['parentMenuId'=>'0'])->one();
         ?>
      </div>

       <div class="line-height">
         <?= $rootModel->menuName ?>
         <input type="button" class="btn btn-success" id="add_<?=$rootModel->id ?>" name="add_<?=$rootModel->id ?>" value="添加" onclick="addMenu(<?=$rootModel->id ?>)">
       </div>

        <?php
        //查询所有有效的一级菜单  2-->全部  1-->有效   0-->无效
        if ($model->isValid!=2) {
          @$firstLevelModels=ComMenu::find()->where(['isValid'=>$model->isValid,'parentMenuId'=>$rootModel->id])->all();
        }
        else
        {
          @$firstLevelModels=ComMenu::find()->where(['parentMenuId'=>$rootModel->id])->all();
        }
        ?>
        <?php if (count($firstLevelModels)>0): ?>
    <ul>
        <?php foreach ($firstLevelModels as $firstLevelModel): ?>

      <li>
        <div class="line-height">
         <?php if ($firstLevelModel->isValid==1) {?>
          <?= $firstLevelModel->menuName ?>
          <div class="right">
               <input type="button" class="btn btn-success" id="add_<?=$firstLevelModel->id ?>" name="add_<?=$firstLevelModel->id ?>" value="添加" onclick="addMenu(<?=$firstLevelModel->id ?>)"> 
             
               <input type="submit" class="btn btn-primary" id="update_<?=$firstLevelModel->id ?>" name="update_<?=$firstLevelModel->id ?>" value="修改" onclick="updateMenu(<?=$firstLevelModel->id ?>)">
                
                 <?= Html::a('作废', ['delete', 'id' =>$firstLevelModel->id,'isValid'=>$model->isValid], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => '确定作废该菜单吗?',
                        'method' => 'post',
                    ],               
                   ]) ?> 
            </div>  
         <?php }  else { ?>
           <div class="graycss"> <?= $firstLevelModel->menuName ?> 
           <div class="right">
           <input type="button" class="btn btn-success" id="add_<?=$firstLevelModel->id ?>" name="add_<?=$firstLevelModel->id ?>" value="添加" onclick="addMenu(<?=$firstLevelModel->id ?>)" disabled="true"> 
         
           <input type="submit" class="btn btn-primary" id="update_<?=$firstLevelModel->id ?>" name="update_<?=$firstLevelModel->id ?>" value="修改" onclick="updateMenu(<?=$firstLevelModel->id ?>)" disabled="true">
             
              <?= Html::a('作废', ['delete', 'id' =>$firstLevelModel->id,'isValid'=>$model->isValid], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '确定作废该菜单吗?',
                    'method' => 'post',
                ],
                'disabled'=>true,
               ])  ?> 

              <?= Html::a('激活', ['active', 'id' =>$firstLevelModel->id,'isValid'=>$model->isValid], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '确定激活该菜单吗?',
                    'method' => 'post',
                ],
               ])  ?> 
            </div>
            </div>        
         <?php }   ?>
   </div>

     
           <?php 
             //查询一级菜单下的所有二级菜单
               if ($model->isValid!=2) {
                  @$secondLevelModels=ComMenu::find()->where(['isValid'=>$model->isValid,'parentMenuId'=>$firstLevelModel->id])->all();  
               }
               else
               {
                 @$secondLevelModels=ComMenu::find()->where(['parentMenuId'=>$firstLevelModel->id])->all();  
               }
           ?>
              
             <?php  if (count($secondLevelModels)>0):  ?>

                  <?php foreach ($secondLevelModels as $secondLevelModel): ?>
            
                    <ul>   
                         <li>
                           <div class="line-height">
                              <?php if ($secondLevelModel->isValid==1) {?>
                             
                               <?= $secondLevelModel->menuName ?>
                              
                               <div style="float:right">
                                  <input type="button" class="btn btn-primary" id="update_<?=$secondLevelModel->id ?>" name="update_<?=$secondLevelModel->id ?>" value="修改" onclick="updateMenu(<?=$secondLevelModel->id ?>)">
                                        <?= Html::a('作废', ['delete', 'id' =>$secondLevelModel->id,'isValid'=>$model->isValid], [
                                             'class' => 'btn btn-danger',
                                             'data' => [
                                                  'confirm' => '确定作废该菜单吗?',
                                                  'method' => 'post',
                                             ],
                                       ]) ?>
                               </div>
                             
                              <?php }  else { ?>
                              <div class="graycss"> <?= $secondLevelModel->menuName ?>
                                <div class="right">
                                    <input type="button" class="btn btn-primary" id="update_<?=$secondLevelModel->id ?>" name="update_<?=$secondLevelModel->id ?>" value="修改" onclick="updateMenu(<?=$secondLevelModel->id ?>)" disabled="true">
                                          <?= Html::a('作废', ['delete', 'id' =>$secondLevelModel->id,'isValid'=>$model->isValid], [
                                               'class' => 'btn btn-danger',
                                               'data' => [
                                                    'confirm' => '确定作废该菜单吗?',
                                                    'method' => 'post',
                                               ],
                                               'disabled'=>true,
                                          ]) ?>
                                    <?= Html::a('激活', ['active', 'id' =>$secondLevelModel->id,'isValid'=>$model->isValid], [
                                      'class' => 'btn btn-danger',
                                      'data' => [
                                          'confirm' => '确定激活该菜单吗?',
                                          'method' => 'post',
                                       ],
                                     ])  ?> 
                                </div>
                               </div>
                              <?php }   ?>
                          </div>
                        </li>
                    </ul>
                  <?php endforeach; ?>

            <?php endif; ?>   
        </li>
        <?php endforeach; ?>
      </ul>
        <?php endif; ?>
      
 </div>



<style type="text/css">
  .graycss{
     color:gray
  }
  .line-height{
    line-height:40px;
  }
  .left{
    float:left
  }
  .right{
    float:right
  }

</style>
<script type="text/javascript">

function addMenu(id)
{
  //var isValidDropStr=$("#isValidDrop").val();
  getLoadInfo(id);
  $("#dialogId").dialog("open");
        $("#dialogId").dialog({
                autoOpen:false,
                modal: true, 
                width: 450,
                height:300,
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
            },
            close: function () {
                $("#dialogId").dialog("close");
            },  
          });
    
}
function getLoadInfo(id){
     $.ajax({
         type:"post",
         url:"index.php?r=com-menu%2Fadd&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

function getUpdateInfo(id){
     $.ajax({
         type:"post",
         url:"index.php?r=com-menu%2Fupdate&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

function updateMenu(id)
{
 //var isValidDropStr=$("#isValidDrop").val();
  getUpdateInfo(id);
  $("#dialogId").dialog("open");
        $("#dialogId").dialog({
                autoOpen:false,
                modal: true, 
                width: 450,
                height:300,
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
             
            },
            close: function () {
                $("#dialogId").dialog("close");
            },  
          });
}


</script>

 