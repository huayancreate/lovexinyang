<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComGoodsReview */

$this->title = 'Update Com Goods Review: ' . ' ' . $model->cgrId;
$this->params['breadcrumbs'][] = ['label' => 'Com Goods Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cgrId, 'url' => ['view', 'id' => $model->cgrId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="com-goods-review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
