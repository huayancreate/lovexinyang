<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CusVerificationCode */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cus Verification Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-verification-code-view">

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
            'orderDetailsId',
            'verificationCode',
            'goodsId',
            'orderNo',
            'number',
            'costPrice',
            'payablePrice',
            'state',
        ],
    ]) ?>

</div>
