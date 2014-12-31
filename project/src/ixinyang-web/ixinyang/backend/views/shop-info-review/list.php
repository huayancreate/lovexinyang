<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\StoSellerInfo;
use yii\jui\Dialog;
use yii\web\JqueryAsset;
use yii\bootstrap\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '店铺信息确认';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-list">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo "请选择时间范围："; ?>
    <?php $form = ActiveForm::begin([
         'action' => ['list'],
         'method' => 'post',
    ]);
    ?>
    <div class="col-lg-5">
        <?php
                 // Date and Time picker with time increment of 15 minutes and without any input group addons.
            echo DateRangePicker::widget([
                'name'=>'date_range_3',
                'value'=> isset(Yii::$app->session['$flag']) ? Yii::$app->session['fromDate'].' to '.Yii::$app->session['$toDate'] : date("Y-m-d").' to '.date("Y-m-d"),
                'convertFormat'=>true,
                'pluginOptions'=>[
                'timePicker'=>false,
                'format'=>'Y-m-d',
                'separator'=>' to ',
                ]
            ]);
        ?>
    </div>
    <?= Html::submitButton('查询', ['class' =>'btn btn-success','id'=>'btnSelect']) ?>
    <?php ActiveForm::end(); ?>
   <hr/>
   <?php echo "当前任务：";?>
   <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'id'=>'shopinforeviewlistGrid',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'shopName',
             [
              'attribute'=>'storeId',
                'label'=>'商家姓名',
                'value'=>function($model){
                   $sellerInfoModel=StoSellerInfo::find()->where(['id'=>$model['storeId']])->one();
                   if (!empty($sellerInfoModel)) {
                       return $sellerInfoModel->owner;
                   }
                   else{
                       return '';
                   }
                   
                }
            ],
             [
              'attribute'=>'applyTime',
                'label'=>'申请时间',
                'value'=>function($model){
                   
                   return date('Y-m-d',strtotime($model['applyTime']));
                }
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
                'buttons'=>[

                        'view'=>function($url,$model){
                              return Html::a('操作','javascript:void(0)',['onClick'=>'getDetailInfo("'.$model['id'].'")']);
                            },
                        'update'=>function(){

                        },
                        'delete'=>function(){

                        },

                 ]
           ],
        ],
    ]); ?>
   <?php \yii\widgets\Pjax::end(); ?>
</div>

<?php 
    Dialog::begin([
        'id'=>'dialogId',
        'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width'=>'500',
            'height'=>'550',
            'resizable'=> true,
        ],
    ]);
?>    

<?php
    Dialog::end();
?>

<script type="text/javascript"> 

<?php $this->beginBlock('JS_END'); ?>

 function getDetailInfo(id){

        getDetailPage(id);

        $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true,
                    width: 800,
                    height:600,
                    title:"店铺信息确认",
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
//弹出dialog 添加对话框
function getDetailPage(id){
     $.ajax({
         type:"POST",
         url:"index.php?r=shop-info-review%2Fdetail&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}


function getView(title,url){
    JuiDialog.dialogView("dialogId",title,url);
}

<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>