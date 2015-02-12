<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use yii\bootstrap\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoBalanceReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '结款审核列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-balance-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
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
   <?php echo "查询结果：";?>
  
   <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'id'=>'balancereviewGrid',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'applyTime',
            'storeName',
            'balanceStartTime',
            'balanceEndTime',
            'applyMoney',
           
            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '50'],
             'template'=>'{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>',
                              Yii::$app->urlManager->createUrl(['cus-consumption-records/closingaudit','id' => $model['id'],'balanceStartTime'=>$model['balanceStartTime'],'balanceEndTime'=>$model['balanceEndTime'],'shopId'=>$model['shopId']]),
                                [
                                 'title' => Yii::t('yii', '结款审核'),
                                 'data-pjax' => '0',
                                 'data' => [
                                      'method' => 'post',
                                    ]
                                ]
                        );
                    }
                ],
            ],
        ],
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>

</div>
<div id="divDialog">
    <?php
    Dialog::begin([
        'id' => 'dialogId',
        'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width' => '600px',
            'height' => '500',
            'title' => '审核详情',
        ]
    ]);
    ?>
    <?php
    Dialog::end();
    ?>
</div>
<script type="text/javascript">
    function View( balanceStartTime,balanceEndTime,shopId,id) {
        getConsumptionRecord(balanceStartTime,balanceEndTime,shopId,id);
        $("#dialogId").dialog("open");
        $("#dialogId").dialog({
            title: '结款审核',
        });

       // $("#dialogContent").load(url);
        //JuiDialog.dialog("dialogId",title,url,"shopinforeviewFrom","gridList");
    }
    //  弹出框信息  根据店铺id 结算起始时间 结算结束时间 查询消费流水记录
    function getConsumptionRecord(balanceStartTime,balanceEndTime,shopId,id){

        $.ajax({
         type:"POST",
         url:"index.php?r=cus-consumption-records/closingaudit",
         data:{balanceStartTime:balanceStartTime,balanceEndTime:balanceEndTime,shopId:shopId,id:id},
         success:function(data) {
            $("#dialogId").html(data);
         }
       });

    }
</script>
