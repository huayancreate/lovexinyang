<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Info Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'city',
            'longitude',
            'latitude',
            'shopName',
            'contact',
            'regional',
            'storeId',
            'storeAccount',
            'businessDistrictId',
            'address',
            'businessHours',
            'storeOutline:ntext',
            'cityId',
            'countyId',
            'applyTime',
            'applyUserId',
            'applyUserName',
            'auditUserId',
            'auditUserName',
            'auditTime:datetime',
            'managerId',
            'managerName',
            'managerTime:datetime',
            'auditState',
            'Rejection',
            'shopBalance',
        ],
    ]) ?>

</div>
