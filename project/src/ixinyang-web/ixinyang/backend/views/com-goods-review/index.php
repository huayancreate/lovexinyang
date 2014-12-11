<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use kartik\daterange\DateRangePicker;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComGoodsReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品申请审核';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-goods-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'post',
        'layout' => 'horizontal',
    ]);
    ?>
    <div class="form-group col-lg-13">
        <label for="inputEmail3" class="col-sm-3 control-label">请选择时间范围</label>
        <div class="col-sm-6">
            <?php
            // Date and Time picker with time increment of 15 minutes and without any input group addons.
            echo DateRangePicker::widget([
                'name' => 'date_range_3',
                'value' => isset(Yii::$app->session['$flag']) ? Yii::$app->session['fromDate'] . ' to ' . Yii::$app->session['$toDate'] : date("Y-m-d" . ' 00:00:00') . ' to ' . date("Y-m-d" . ' 23:59:59'),
                'convertFormat' => true,
                'pluginOptions' => [
                    'timePicker' => true,
                    'timePickerIncrement' => 15,
                    'format' => 'Y-m-d h:i:s',
                    'separator' => ' to ',
                ]
            ]);
            ?>
        </div>
        <?= Html::submitButton('查询', ['class' => 'btn btn-success', 'id' => 'btnSelect']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <hr>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cgrId',
            'goodsId',
            'goodsName',
            'applyerId',
            'applyerAccount',
            // 'enterAccount',
            // 'storeId',
            // 'storeName',
            // 'supplyTime',
            // 'goodsPrice',
            // 'goodsIntroduction',
            // 'goodsType',
            // 'goodsDescription',
            // 'goodsName',
            // 'goodsValidityDate',
            // 'goodsId',
            // 'goodsStatus',
            // 'memberDiscount',

            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '60'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('审核', 'javascript:void(0)', [
                            'onClick' => 'View("申请审核","index.php?r=goods-apply-info/update&id=' . $model['goodsId'] . '")'
                        ]);
                    },
                    'update' => function () {

                    },
                    'delete' => function () {

                    },
                ]
            ],
        ],
    ]); ?>

</div>
<?php
Dialog::begin([
    'id' => 'viewDialog',
    'clientOptions' => ['modal' => true, 'autoOpen' => false],]);
?>
<div id="view"></div>
<?php
Dialog::end();
?>
<script type="text/javascript">
    function View(title, url) {
        $("#viewDialog").dialog({
            width: 800,
            height: 500,
            title: title,
            resizable: true,
            overlay: {
                opacity: 0.5,
                background: "black",
                overflow: 'auto'
            },
            close: function () {
                //$.pjax.reload({container: '#w0'});
            },
            buttons: {
                '审核通过': function () {
                    Verify(url, 1);//审核通过
                    //SaveOrUpdate(url);
                    $(this).dialog('close');

                },
                "审核驳回": function () {
                    Verify(url, 2);//审核驳回
                    $(this).dialog('close');
                }
            },
            open: function () {
                $("#viewDialog").load(url);
            }
        });
        $("#viewDialog").dialog("open");
    }
    function Verify(url, type) {
        $.ajax({
            cache: true,
            type: "POST",
            url: url + "&type=" + type,
            data: $('#accountForm').serialize(),// 你的formid
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                //alert(data);
                $.pjax.reload({container: '#w0'});
            }
        });
    }

</script>
