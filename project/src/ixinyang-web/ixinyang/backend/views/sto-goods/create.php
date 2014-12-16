<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */

$this->title = 'Create Sto Goods';
$this->params['breadcrumbs'][] = ['label' => 'Sto Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-goods-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categoryModel'=>$categoryModel,
        'categoryList'=>$categoryList
    ]) ?>

</div>
