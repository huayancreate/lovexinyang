<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ComBusinessDistrict;
use backend\models\ComCityCenter;
use backend\models\ComCounty;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Info Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-view">

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'shopName',
            'contact',
            [
                'label'=>'城市',
                'value'=>ComCityCenter::findOne($model->cityId)->cityCenterName,
            ],
            [
                'label' => '区县',
                'value' => ComCounty::findOne($model->countyId)->countyName,
            ],
            [
                'label' => '商圈',
                'value' => ComBusinessDistrict::findOne($model->businessDistrictId)->businessDistrictName,
            ],
            'address',
            'businessHours',
            [
                'label'=>'审核状态',
                'value'=>$model->getState($model->auditState),
            ],
            'storeOutline:ntext',
            'longitude',
            'latitude',
            'Rejection',
        ],
    ]) ?>

</div>
