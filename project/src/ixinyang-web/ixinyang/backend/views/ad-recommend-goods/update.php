<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdRecommendGoods */

$this->title = 'Update Ad Recommend Goods: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ad Recommend Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-recommend-goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
