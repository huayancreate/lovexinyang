<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ComCounty;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="comcounty_businessdistrictlist">
<!--  <div class="row">
   <div class="col-lg-12"> 
 
  </div> 
</div>  -->
<div clss="row">
    <div class="col-lg-8">
    <?= Html::button('添加', ['class' =>'btn btn-success','onclick'=>"businessdisAdd(".$countyId.")"]) ?>
    <?= GridView::widget([
        'dataProvider' => $ComBusinessDistrictdataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'countyId',
                'label'=>'区县名称',
                'value'=>function($ComBusinessDistrict){
                  $comCountyModel=ComCounty::find()->where(['countyId'=>$ComBusinessDistrict['countyId']])->one();
                  return $comCountyModel->countyName;
                }

            ],
            'businessDistrictCode',
            'businessDistrictName',
            [
                'attribute'=>'isValid',
                'label'=>'是否有效',
                'value'=>function($ComBusinessDistrict){
                  
                  return $ComBusinessDistrict['isValid']==1 ? "有效": "无效";
                }
            ],
            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
            //'template'=>'{view}{update}{delete}{create}',
            'buttons'=>[
                'update'=>function($url,$ComBusinessDistrict){
                     /* return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                      Yii::$app->urlManager->createUrl(['comcounty/businessdistrictupdate','businessDistrictId' => $ComBusinessDistrict['businessDistrictId']]),
                        [
                         'title' => Yii::t('yii', 'Update'),
                        'data-pjax' => '0',
                        ]);*/
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>','javascript:void(0)',['onclick'=>"updateBusdisFun(".$ComBusinessDistrict['businessDistrictId'].")"]);
                    },
                'view'=>function($url,$ComBusinessDistrict){
                     
                    },
                'delete'=>function($url,$ComBusinessDistrict){
                              return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                              Yii::$app->urlManager->createUrl(['comcounty/businessdistrictdelete','businessDistrictId' => $ComBusinessDistrict['businessDistrictId']]),
                                [
                                 'title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                 'data' => [
                                      'confirm' => '确定删除该商圈吗?',
                                      'method' => 'post',
                                    ]
                                ]
                                );
                            }             
             ]
         ],
       ],
   
    ]); ?>
    </div>

   
</div>
</div>


<script type="text/javascript"> 
$(function(){
    $("table").removeClass("table-striped");
});
function businessdisAdd(countyId){
      //弹出dialog 添加对话框

      getBusinessdisLoadInfo(countyId);
      $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 450,
                    height:350,
                    title:"商圈添加",
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
                   //$("#dialogId").empty();
                    $("#dialogId").dialog("close");
                },  
              });
    }

//弹出dialog 添加对话框
function getBusinessdisLoadInfo(countyId){
     $.ajax({
         type:"post",
         url:"index.php?r=comcounty/businessdistrictadd&countyId="+countyId,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}
function updateBusdisFun(busdisId){
  
    getBusinessdisUpdateInfo(busdisId);
    $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 450,
                    height:350,
                    title:"商圈修改",
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
                   //$("#dialogId").empty();
                   $("#dialogId").dialog("close");
                },  
              });
}
//弹出dialog 修改对话框
function getBusinessdisUpdateInfo(busdisId){
     $.ajax({
         type:"get",
         url:"index.php?r=comcounty/businessdistrictupdate&businessDistrictId="+busdisId,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}
</script>

 

