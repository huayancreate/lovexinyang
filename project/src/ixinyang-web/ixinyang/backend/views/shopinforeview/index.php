<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Info Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Shop Info Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'city',
            //'longitude',
            //'latitude',
            'shopName',
            'contact',
            // 'regional',
            // 'storeId',
            // 'storeAccount',
            // 'businessDistrictId',
            'address',
            'businessHours',
            // 'storeOutline:ntext',
            // 'cityId',
            // 'countyId',
            // 'applyTime',
            // 'applyUserId',
            // 'applyUserName',
            // 'auditUserId',
            // 'auditUserName',
            // 'auditTime:datetime',
            // 'managerId',
            // 'managerName',
            // 'managerTime:datetime',
            'auditState',
            // 'Rejection',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
