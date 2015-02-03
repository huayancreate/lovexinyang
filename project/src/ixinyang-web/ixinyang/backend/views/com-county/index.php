<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use backend\models\ComCityCenter;
use backend\controllers\ComCountyController;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\Dialog;
use yii\web\jqueryAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '区县管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="com-county-index">

  <div class="row">
   <?php $form = ActiveForm::begin([
         'layout' => 'horizontal',
         'action' => ['search'],
         'method' => 'post',
    ]);
    ?>
    <div class="col-lg-6">

        <?= $form->field($model, 'isValid')->dropDownList([
            '2'=>'全部',
            '1'=>'有效',
            '0'=>'无效',
        ],
        ['name'=>'isValidDrop','value'=>isset(Yii::$app->session['$isValid']) ? Yii::$app->session['$isValid'] : $model->isValid])
        ?>
    </div>
    <?= Html::submitButton('查询', ['class' =>'btn btn-success','id'=>'btnSelect']) ?>
    <?php ActiveForm::end(); ?> 
  
</div>
 <div class="row">

    <div class="col-lg-8">

     <?= Html::button('区县添加', ['class' =>'btn btn-success','id'=>'countyAdd']) ?>
     <?php \yii\widgets\Pjax::begin(); ?>
     <?= GridView::widget([
        'id'=>'countyGrid',
        'dataProvider' => $dataProvider,
        'tableOptions'=>['class'=>'','id'=>'test123'],
        'rowOptions' => function ($model, $key, $index, $grid) {
                return ['id' => $model['countyId'],'onclick'=>"dosubmit('".$model['countyId']."',this)"];
        },
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
             [
                'attribute'=>'cityCenterId',
                'label'=>'市区名称',
                'value'=>function($data){
                  $ComCityCenterModel=ComCityCenter::find()->where(['id'=>$data['cityCenterId']])->one();
                  if (!empty($ComCityCenterModel)) {
                      return $ComCityCenterModel->cityCenterName;
                  }
                  else{
                      return '';
                  }
                  
                },
            ],
            'countyName',
           
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
                              Yii::$app->urlManager->createUrl(['com-county/delete','id' => $model['countyId']]),
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

<script type="text/javascript"> 
<?php
  $this->beginBlock('JS_END');
?>
$(function(){

    $("#countyAdd").click(function(){
      //弹出dialog 添加对话框
      getLoadInfo();
      $("#dialogId").dialog("open");

            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 450,
                    height:300,
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
                 
                },
                close: function () {
                    $("#dialogId").dialog("close");
                },  
              });
    });
});

//弹出dialog 添加对话框
function getLoadInfo(){
     $.ajax({
         type:"post",
         url:"index.php?r=com-county%2Fcreate",
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

//弹出dialog 修改对话框
function getUpdateInfo(id){
    $.ajax({
         type:"get",
         url:"index.php?r=com-county%2Fupdate&id="+id,
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
                    height:300,
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
                },
                close: function () {
                    $("#dialogId").dialog("close");
                },  
              });
}

//把商圈列表页面加载出来
function dosubmit(id,obj){

    var _table=obj.parentNode;
    for (var i=0;i<_table.rows.length;i++){
       for (var j=0; j<_table.rows[i].cells.length; j++) {

        var td =$(_table.rows[i].cells[j]);
        $(td).css("background-color","");
       };
    } 
    $(obj).children("td").css("background-color","#AAAAAA");
  
   $.ajax({
           type:"post",
           url:"index.php?r=com-county/selectinfo&countyId="+id,
           success:function(data) {
               $("#businessdistrictDiv").html(data);
           }
       });
} 



<?php
  $this->endBlock();
?>
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

<?php 
$this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END);
?>

