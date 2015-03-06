<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */

$this->title = 'Update Sto Goods: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sto Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sto-goods-update">

    <?= $this->render('_form', [
        'model' => $model,'categoryModel'=>$categoryModel,
        'goodsStoreModel'=>$goodsStoreModel,
        'category' => $category,
    ]) ?>

</div>
