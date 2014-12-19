<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sto Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-goods-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'goodsName',
            'summary',
            'describes',
            'price',
            'subClass',
            'validity',
            'supplyDateTime',
            'enjoyRebate',
            'goodsGrade',
            'goodsWeight',
            'goodsState',
        ],
    ]) ?>

</div>
