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
        'userName',
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

        'id',
        'orderId',
        'goodsName',
        'goodsId',
        'price',
        // 'totalPrice',
        // 'rebate',
        // 'rebatePrice',
        // 'totalNum',
        // 'sellerId',
        // 'memberCardNo',

//        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
<form class="form-horizontal" id="reasonForm" role="form" style="display: none">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">驳回原因：</label>

        <div class="col-sm-9">
            <?= Html::textarea("refundReason", '', ['class' => 'form-control', 'placeholder' => '驳回原因']) ?>
        </div>
    </div>
</form>

