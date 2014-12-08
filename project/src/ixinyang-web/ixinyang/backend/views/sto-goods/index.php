<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sto Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sto Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'goodsName',
            'summary',
            'describes',
            'price',
            // 'subClass',
            // 'validity',
            // 'supplyDateTime',
            // 'enjoyRebate',
            // 'goodsGrade',
            // 'goodsWeight',
            // 'goodsState',
            // 'createDate',
            // 'createID',
            // 'createName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
