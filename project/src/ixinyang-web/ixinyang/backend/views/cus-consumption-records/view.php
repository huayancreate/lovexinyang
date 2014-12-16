<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CusConsumptionRecords */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cus Consumption Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-consumption-records-view">

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
            'orderNo',
            'orderId',
            'goodsId',
            'verfificationCode',
            'goodsNumber',
            'costPrice',
            'payablePrice',
            'rebate',
            'userAccount',
            'memberCardNo',
            'sellerId',
            'sellerAccount',
            'verifierAccount',
            'verifierTime',
        ],
    ]) ?>

</div>
