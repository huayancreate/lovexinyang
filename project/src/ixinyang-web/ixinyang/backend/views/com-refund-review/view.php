<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundReview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Com Refund Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-review-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'userName',
            'userAccount',
            'orderName',
            'storeName',
            'busiName',
            'applyTime',
            'refundMoney',
            'refundReason',
            //'id',
            //'financeId',
            //'financeAccount',
            'financeReviewTime',
            [
                'attribute' => 'financeReviewStatus',
                'value' => '待审核',
            ],
            //'reviewId',
            //'reviewAccount',
            //'reviewTime',
            //'reviewStatus',
            //'orderId',

            //'busiId',

            //'storeId',

            //'verificationCode',

        ],
    ]) ?>

</div>
