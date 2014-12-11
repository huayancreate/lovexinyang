<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ComBusinessDistrict;
use backend\models\ComCounty;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */
$this->params['breadcrumbs'][] = ['label' => 'Sto Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-goods-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'storeName',
            'storePhone',
            'otherContact',
            'scopeBusiness',
            [
                'label'=>'区域',
                'value'=>ComCounty::findOne($model->regional)->countyName,
            ],
            [
                'label' => '商圈',
                'value' => ComBusinessDistrict::findOne($model->businessZone)->businessDistrictName,
            ],
            'phone',
            'address',
            'name',
            'email',
        ],
    ]) ?>

</div>
