<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComGoodsReviewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Com Goods Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-goods-review-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Com Goods Review', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cgrId',
            'goodsId',
            'goodsName',
            'applyerId',
            'applyerAccount',
            // 'applyTime',
            // 'reviewerId',
            // 'reviewerName',
            // 'reviewTaskId',
            // 'reviewTime',
            // 'reviewStatus',
            // 'remark',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
