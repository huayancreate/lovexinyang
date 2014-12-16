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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'financeId',
            'financeAccount',
            'financeReviewTime',
            'financeReviewStatus',
            'reviewId',
            'reviewAccount',
            'reviewTime',
            'reviewStatus',
            'orderId',
            'orderName',
            'busiName',
            'busiId',
            'storeName',
            'storeId',
            'applyTime',
            'refundMoney',
            'refundReason',
            'verificationCode',
            'userName',
            'userAccount',
        ],
    ]) ?>

</div>
