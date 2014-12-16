<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoSellerInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '财务数据';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-seller-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo yii\bootstrap\Tabs::widget([
        'items' => [
            [
                'label' => '余额',
                'content' =>
                    '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                    Html::label('余额：').
                    Html::label($dataProvider->accountBalance == null ?"无余额":$dataProvider->accountBalance)
                    . "</div>",
                'active' => true,
            ],
            [
                'label' => '结款',
                'content' =>
                    '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">' .
                    $this->render('../sto-seller-info/settleAccounts', ['model' => $model])
                    . "</div>",
            ],
            [
                'label' => '退款',
                'content' =>
                    '<form id="refundSearch" class="form-horizontal" action="index.php?r=sto-seller-info/refund" method="post" role="form">
                    <div id="refundForm" style="border:1px solid #ccc;border-top:0px;padding:15px;">
                    <div class="form-group">
                    <label for="inputEmail3" class="col-sm-3 control-label">请选择时间范围:</label>
                    <div class="col-sm-7">' .
                    DateRangePicker::widget([
                        'name' => 'dateRangeRefund',
                        'value' => isset(Yii::$app->session['$flag']) ? Yii::$app->session['fromDate'] . ' to ' . Yii::$app->session['$toDate'] : date("Y-m-d") . ' to ' . date("Y-m-d"),
                        'convertFormat' => true,
                        'pluginOptions' => [
                            'timePicker' => false,
                            'timePickerIncrement' => 15,
                            'format' => 'Y-m-d',
                            'separator' => ' to ',
                        ]
                    ]) .
                    '</div>'.
                    Html::button('查询', ['class' => 'btn btn-success', 'onclick' => 'Search()']) .
                    '</div></form>'.
                    $this->render('../sto-seller-info/refundList', ['refundDataProvider' => $refundDataProvider])
            ],
        ],
    ]);
    ?>
</div>
<script type="text/javascript">

</script>
