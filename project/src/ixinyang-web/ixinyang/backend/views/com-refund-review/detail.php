<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-18
 * Time: 22:31
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\DetailView;

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Com Refund Reviews', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $order,
    'attributes' => [
        'orderNo',
        'totalPrice',
        'userAccount',
        'userId',
        'payTotalPrice',
        'buyTime',
        'methodsPayment',
        'paymentAccount',
    ],
]) ?>

<?= GridView::widget([
    'dataProvider' => $orderDetail,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'id',
        'orderId',
        'goodsName',
        'goodsId',
        'price',
        'totalPrice',
        // 'rebate',
        // 'rebatePrice',
        // 'totalNum',
        // 'sellerId',
        // 'memberCardNo',

//        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<form class="form-horizontal" id="reasonForm" role="form">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">审核意见：</label>
        <div class="col-sm-9">
            <?= Html::textarea("remark", '', ['id' => 'remark', 'class' => 'form-control', 'placeholder' => '审核意见']) ?>
        </div>
    </div>
</form>

