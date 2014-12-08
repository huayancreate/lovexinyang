<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComGoodsReview */

$this->title = 'Create Com Goods Review';
$this->params['breadcrumbs'][] = ['label' => 'Com Goods Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-goods-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
