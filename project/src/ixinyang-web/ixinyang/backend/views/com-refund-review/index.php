<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComRefundReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Com Refund Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Com Refund Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'financeId',
            'financeAccount',
            'financeReviewTime',
            'financeReviewStatus',
            // 'reviewId',
            // 'reviewAccount',
            // 'reviewTime',
            // 'reviewStatus',
            // 'orderId',
            // 'orderName',
            // 'busiName',
            // 'busiId',
            // 'storeName',
            // 'storeId',
            // 'applyTime',
            // 'refundMoney',
            // 'refundReason',
            // 'verificationCode',
            // 'userName',
            // 'userAccount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
