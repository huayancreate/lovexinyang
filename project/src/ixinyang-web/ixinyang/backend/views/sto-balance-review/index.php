<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoBalanceReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '结款审核列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-balance-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--    <p>-->
    <!--<?= Html::a('Create Sto Balance Review', ['create'], ['class' => 'btn btn-success']) ?>-->
    <!--    </p>-->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'financeId',
            //'financeAccount',
            //'financeReviewStatus',
            //'reviewId',
            'reviewAccount',
            //'reviewTime',
            'reviewStatus',
            // 'serviceFee',
            // 'serviceAgreement',
            'balanceStartTime',
            'balanceEndTime',
            // 'storeId',
            'storeName',
            // 'applyerId',
            'applyerAccount',
            'applyMoney',
            // 'actualBalanceMoney',
            // 'financeReviewTime',
            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '50'],
                'buttons' => [
                    'view' => function () {
                        return Html::a('<span class="glyphicon glyphicon-cog"></span>', 'javascript:void(0)',
                            [
                                'title' => Yii::t('yii', '结款审核'),
                                'onClick' => 'View("结款审核","index.php?r=com-account/view&id=1")'
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

</div>
<div id="divDialog">
    <?php
    Dialog::begin([
        'id' => 'dialogId',
        'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width' => '600px',
            'height' => 'auto',
            'title' => '审核详情',
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
    function View() {
        $("#dialogId").dialog("open");
        $("#dialogContent").load("index.php?r=sto-balance-review/index");
    }
    function Verify() {

    }
</script>