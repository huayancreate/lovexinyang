<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsApplyInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods Apply Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-apply-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goods Apply Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shopId',
            'shopName',
            'stock',
            'enterId',
            // 'enterAccount',
            // 'storeId',
            // 'storeName',
            // 'supplyTime',
            // 'goodsPrice',
            // 'goodsIntroduction',
            // 'goodsType',
            // 'goodsDescription',
            // 'goodsName',
            // 'goodsValidityDate',
            // 'goodsId',
            // 'goodsStatus',
            // 'memberDiscount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
