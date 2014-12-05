<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

   <!--  <p>
        <?= Html::a('新增店铺信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'layout'=>'{items}',
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'storeName',
        'storeAddress',
        'storeType',
        'contactWay',
        'businessHours',
        ['class' => 'yii\grid\ActionColumn'],
    ],
]); ?>
