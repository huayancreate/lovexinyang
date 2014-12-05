<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use backend\models\ComCityCenter;
use backend\controllers\ComcountyController;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '区县管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-county-index">

 <div class="row">
    <div class="col-lg-8">
     <?= Html::button('添加', ['class' =>'btn btn-success','id'=>'countyAdd']) ?>
     <?php \yii\widgets\Pjax::begin(); ?>
     <?= GridView::widget([
        'id'=>'countyGrid',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn',],
            [
                'attribute'=>'countyId',
                'label'=>'区县id',
                'value'=>function($data){

                   return $data['countyId'];
                },
               // 'visible' => false
            ],

            'countyName',
            [
                'attribute'=>'cityCenterId',
                'label'=>'市区名称',
                'value'=>function($data){
                  $ComCityCenterModel=ComCityCenter::find()->where(['id'=>$data['cityCenterId']])->one();
                  return $ComCityCenterModel->cityCenterName;
                },
            ],
            [
                'attribute'=>'isValid',
                'label'=>'是否有效',
                'value'=>function($data){
                  
                  return $data['isValid']==1 ? "有效": "无效";
                }
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
                'buttons'=>[
                'view'=>function($url,$model){

                },
                'update'=>function($url,$model){
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>','javascript:void(0)',['onclick'=>"updateFunction(".$model['countyId'].")"]);
                    },
                'delete'=>function($url,$model){
                              return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                              Yii::$app->urlManager->createUrl(['comcounty/delete','id' => $model['countyId']]),
                                [
                                 'title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                 'data' => [
                                      'confirm' => '确定删除该区县吗?',
                                      'method' => 'post',
                                    ]
                                ]
                                );
                            }             
             ]


            ],
             
        ],
     ]); ?>
     <?php \yii\widgets\Pjax::end(); ?>
    </div>  
 </div>


<!--商圈部分-->
<div id="businessdistrictDiv" >
 
</div>

</div>

<style type="text/css">
.trSelected{ 
background-color: #B0E0E6; 
} 
</style>

<script src="/yiitest/backend/web/assets/1d84e5b1/jquery.js"></script>

<script type="text/javascript"> 
$(function(){
    $("table").removeClass("table-striped");

    $("#countyAdd").click(function(){
      //弹出dialog 添加对话框
      getLoadInfo();
      $("#dialogId").dialog("open");

            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 450,
                    height:250,
                    title:"区县添加",
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
                   // $("#formtest input").val('');
                   
                    $("#dialogId").dialog("close");
                },  
              });
    });
});

//触发行事件 点击某行区县 区县下对应的商圈加载出来
$("table tr:gt(0)").bind("click",function(){
    $("table tr:gt(0)").removeClass("trSelected");
    $(this).addClass("trSelected");
    $("#businessdistrictDiv").show();
    
    var id=$(this).attr("data-key");
    dosubmit(id);
    //alert(id);
      
});

 //把商圈列表页面加载出来
 function dosubmit(id){
     $.ajax({
         type:"post",
         url:"index.php?r=comcounty/selectinfo&countyId="+id,
         success:function(data) {
             $("#businessdistrictDiv").html(data);
         }
     });
 }

//弹出dialog 添加对话框
function getLoadInfo(){
     $.ajax({
         type:"post",
         url:"index.php?r=comcounty%2Fcreate",
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

//弹出dialog 修改对话框
function getUpdateInfo(id){
    $.ajax({
         type:"get",
         url:"index.php?r=comcounty%2Fupdate&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

function updateFunction(id){
    getUpdateInfo(id);
     $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 450,
                    height:250,
                    title:"区县修改",
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
                    //$("#formtest input").val('');
                    
                    $("#dialogId").dialog("close");
                },  
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
