<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use backend\models\StoApplyInfo;
use backend\models\ComCategoryMaintain;
use kartik\daterange\DateRangePicker;
use yii\jui\Dialog;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoApplyInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商家申请信息审核';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sto-apply-info-index">
    <h1><?= Html::encode("商家申请信息审核列表") ?></h1>
    <hr>
    <?php echo "请选择时间范围："; ?>
    <?php $form = ActiveForm::begin([
         'action' => ['index'],
         'method' => 'post',
    ]); 
    ?>
    <div class="col-lg-6">
        <?php
                 // Date and Time picker with time increment of 15 minutes and without any input group addons.
            echo DateRangePicker::widget([
                'name'=>'date_range_3',
                'value'=> isset(Yii::$app->session['$flag']) ? Yii::$app->session['fromDate'].' to '.Yii::$app->session['$toDate'] : date("Y-m-d".' 00:00:00').' to '.date("Y-m-d".' 23:59:59'),
                'convertFormat'=>true,
                'pluginOptions'=>[
                'timePicker'=>true,
                'timePickerIncrement'=>15,
                'format'=>'Y-m-d h:i:s',
                'separator'=>' to ',
                ]
            ]);
        ?>
    </div>
    <?= Html::submitButton('查询', ['class' =>'btn btn-success','id'=>'btnSelect']) ?>
    <?php ActiveForm::end(); ?>

    <hr>
    <?php echo "最近消费记录：";?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'id'=>'stoapplyinfoGrid',
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'applyTime',
            'storeName',
            'name',
            'phone',
            'address',
            [
                'attribute'=>'countyId',
                'label'=>'商家类型',
                'value'=>function($model){
                      $comCategoryMaintainModel=ComCategoryMaintain::find()->where(['id'=>$model['storeCategoryId']])->one();
                      if (!empty($comCategoryMaintainModel)) {
                         return $comCategoryMaintainModel->categoryName;
                      }
                      else{
                            return '';
                      }
                      
                      
                }

            ],
            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
                'buttons'=>[
                
                        'view'=>function($url,$model){
                              return Html::a('明细','javascript:void(0)',['onclick'=>"detailFunction(".$model['applyId'].")"]);
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
<script type="text/javascript">
   <?php $this->beginBlock('JS_END'); ?>
      function detailFunction(applyId){

        getDetailInfo(applyId);

        $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 800,
                    height:600,
                    title:"商家申请信息审核明细",
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
      function getDetailInfo(applyId){
           $.ajax({
               type:"POST",
               url:"index.php?r=sto-apply-info%2Fdetail&applyId="+applyId,
               success:function(data) {
                  $("#dialogId").html(data);
               }
             });
      }
  
   <?php $this->endBlock(); ?>
</script>
<?php
  \yii\web\YiiAsset::register($this);
  $this->registerJs($this->blocks['JS_END'],\yii\web\View::POS_END);
?>

<!---对话框 -->
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
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/zTreeStyle.css', []);
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/map/map.css', []);

$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/map/map.js',  ['depends' => [JqueryAsset::className()]]);
//$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/jquery.ztree.core-3.5.min.js',  ['depends' => [JqueryAsset::className()]]);
?>





