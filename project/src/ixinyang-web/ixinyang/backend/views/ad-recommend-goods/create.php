<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdRecommendGoods */

/*$this->title = 'Create Ad Recommend Goods';
$this->params['breadcrumbs'][] = ['label' => 'Ad Recommend Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="ad-recommend-goods-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,'jsonStoreInfo'=>$jsonStoreInfo,'jsonStoGoods'=>$jsonStoGoods
    ]) ?>

</div>
