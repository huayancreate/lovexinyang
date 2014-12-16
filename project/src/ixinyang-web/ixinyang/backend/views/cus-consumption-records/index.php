<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CusConsumptionRecordsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cus Consumption Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-consumption-records-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cus Consumption Records', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'orderNo',
            'orderId',
            'goodsId',
            'verfificationCode',
            // 'goodsNumber',
            // 'costPrice',
            // 'payablePrice',
            // 'rebate',
            // 'userAccount',
            // 'memberCardNo',
            // 'sellerId',
            // 'sellerAccount',
            // 'verifierAccount',
            // 'verifierTime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
