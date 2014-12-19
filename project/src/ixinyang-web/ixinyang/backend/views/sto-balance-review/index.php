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
                'timePicker'=>true,
                'timePickerIncrement'=>15,
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
   <?php 
      print_r($dataProvider);
   ?>
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
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('操作', 'javascript:void(0)',
                            [
                                'title' => Yii::t('yii', '结款审核'),
                                //'onClick' => 'View("结款审核","index.php?r=cus-consumption-records/index&id=' . $model['id'] .'&balanceStartTime='.$model['balanceStartTime'].'&balanceEndTime='.$model['balanceEndTime'].'&shopId='.$model['shopId'].'")'
                                 'onClick' => 'View("'.$model['balanceStartTime'].'","'.$model['balanceEndTime'].'","'.$model['shopId'].'","'.$model['id'].'")'
                            ]);
                    },
                    'update' => function () {
                        return null;
                    },
                    'delete' => function () {
                        return null;
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
        ],
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
            buttons: [
                /*{
                    text: '审核通过',
                    class: 'btn btn-success',
                    click: function () {
                        Verify("1");//审核通过
                    }
                },
                {
                    text: '审核驳回',
                    class: 'btn btn-danger',
                    click: function () {
                        Verify("0");//审核驳回
                    }
                }*/
            ]
        });

       // $("#dialogContent").load(url);
        //JuiDialog.dialog("dialogId",title,url,"shopinforeviewFrom","gridList");
    }
   /* function Verify(status) {
        $.ajax({
            cache: true,
            type: "POST",
            url: "index.php?r=sto-balance-review/Verify&id=1",
            data: $('#accountForm').serialize(),
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                //alert(data);
                $.pjax.reload({container: '#accountList'});
            }
        });
    }*/
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
