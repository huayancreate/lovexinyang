<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StoSellerInfo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sto Seller Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-seller-info-view">

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
            'customerManager',
            'contractId',
            'otherContactWay',
            'summary',
            'sellerName',
            'sellerdetails',
            'validity',
            'contacts',
            'phone',
            'email:email',
            'accountBalance',
        ],
    ]) ?>

</div>
