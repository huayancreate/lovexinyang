<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;
use yii\bootstrap\ActiveForm;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComRefundReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '财务退款审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'layout' => 'horizontal'
    ]);
    ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">请选择时间范围:</label>

        <div id="dateRange" class="col-sm-7">
            <?php
            echo DateRangePicker::widget([
                //'id'=>'dateRange',
                'name' => 'dateRange',
                'convertFormat' => true,
                'value' => $dateRange,
                'pluginOptions' => [
                    'timePicker' => false,
                    'timePickerIncrement' => 15,
                    'format' => 'Y-m-d',
                    'separator' => ' to ',
                    //'minDate' => $model,
                    //'singleDatePicker'=>true,
                ]
            ]);
            ?>
        </div>

        <?= Html::submitButton('查询', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php \yii\widgets\Pjax::begin(['id' => 'refundReviewList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'financeId',
            'financeAccount',
            'financeReviewTime',
            [
                'attribute' => 'financeReviewStatus',
                'label' => '财务审核状态',
                'filter' => false,
                'value' => function ($model) {
                    return "待审核";
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '50'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-cog"></span>', 'javascript:void(0)',
                            [
                                'title' => Yii::t('yii', '退款审核'),
                                'onClick' => 'View("退款审核明细","index.php?r=com-refund-review/detail&id=' . $model['orderId'] . '","' . $model['id'] . '")'
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
            'resizable' => true,
        ],
    ]);
    ?>
    <div id="dialogContent">
        <!--填充弹出框内容-->
    </div>
    <?php
    Dialog::end();
    ?>
</div>

<script type="text/javascript">
    function View(title, url, id) {
        $("#dialogId").dialog("open");
        $('#dialogId').dialog({
            title: title,
            buttons: [
                {
                    text: "审核通过",
                    "class": 'btn btn-success',
                    click: function () {
                        Verify("1", id);
                        $(this).dialog('close');
                    }
                },
                {
                    text: "审核驳回",
                    "class": 'btn btn-danger',
                    click: function () {
                        var remark = $("#remark").val();
                        if (remark == "") {
                            alert("请输入审核意见");
                        } else {
                            if (confirm("是否确定审核驳回？")) {
                                Verify("2", id);
                                $(this).dialog('close');
                            }
                        }
                    }
                }
            ]
        });
        $("#dialogContent").load(url);
    }

    function Verify(status, id) {
        $.ajax({
            cache: true,
            type: "POST",
            url: "index.php?r=com-refund-review/verify",
            data: {id: id, status: status, remark: $("#remark").val()},
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                $.pjax.reload({container: '#refundReviewList'});
            }
        });
    }
</script>