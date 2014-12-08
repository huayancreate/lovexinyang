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
     <div class="col-lg-6">
        <?php  echo "所有菜单信息</br>"; ?>
       

         <?php echo "是否有效"; ?>
       
        <select id="isValidDrop"  onchange="isValidDropFunction()" >
          <option value="2" <?php if ($model->isValid == '2') echo 'selected'; ?>>全部</option>
          <option value="1" <?php if ($model->isValid == '1') echo 'selected'; ?>>是</option>
          <option value="0" <?php if ($model->isValid == '0') echo 'selected'; ?>>否</option>
        </select>

        <div id="showMenuInfoDiv">
          
        </div>
    </div> 
  </div>
</div>


<script type="text/javascript">
  //加load事件 页面刚加载时执行的函数
  if (window.attachEvent) {
      window.attachEvent("onload", loadMenuInfo);//IE
  }
  else {
      window.addEventListener("load", loadMenuInfo, false);//FF
  }

  function loadMenuInfo()
  {
    $.ajax({
           type:"post",
           url:"index.php?r=com-menu%2Fsearch",
           data:{isValid:2},
           success:function(data) {
             $("#showMenuInfoDiv").html(data);
           }
         });
  }

   function isValidDropFunction()
     {
         var isValidDropStr=$("#isValidDrop").val();
         $.ajax({
           type:"post",
           url:"index.php?r=com-menu%2Fsearch",
           data:{isValid:isValidDropStr},
           success:function(data) {
              $("#showMenuInfoDiv").html(data);
           }
         });

          
         
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

<?php
    Dialog::end();
?>