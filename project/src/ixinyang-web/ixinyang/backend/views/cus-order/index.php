<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CusOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cus Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cus Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'orderNo',
            'totalPrice',
            'userAccount',
            'userName',
            // 'payTotalPrice',
            // 'buyTime',
            // 'methodsPayment',
            // 'paymentAccount',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
