<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundStream */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Com Refund Streams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-stream-view">

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
            'operatorId',
            'operatorAccount',
            'operateTime',
            'loadTime',
            'loadAlipayName',
            'loadAlipayAccount',
            'refundMoney',
            'refundStreamId',
            'refundTime',
            'refundApplyId',
            'refundApplyTime',
            'verificationCode',
            'userId',
            'userAccount',
            'payAlipayName',
            'payAlipayAccount',
            'alipayStreamNumber',
        ],
    ]) ?>

</div>
