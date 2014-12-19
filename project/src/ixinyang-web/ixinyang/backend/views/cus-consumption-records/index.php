<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '截至到结算日期的消费明细';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-consumption-records-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <label>总计：(￥)</label>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'verifierTime',
            'userAccount',
            'goodsNumber',
            'payablePrice',
            'verifierAccount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
