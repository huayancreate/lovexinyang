<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComRefundStreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Com Refund Streams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-stream-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Com Refund Stream', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'operatorId',
            'operatorAccount',
            'operateTime',
            'loadTime',
            // 'loadAlipayName',
            // 'loadAlipayAccount',
            // 'refundMoney',
            // 'refundStreamId',
            // 'refundTime',
            // 'refundApplyId',
            // 'refundApplyTime',
            // 'verificationCode',
            // 'userId',
            // 'userAccount',
            // 'payAlipayName',
            // 'payAlipayAccount',
            // 'alipayStreamNumber',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
