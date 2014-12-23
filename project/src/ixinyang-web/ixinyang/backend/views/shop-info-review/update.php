<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */

$this->title = 'Update Shop Info Review: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Shop Info Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-info-review-update">

	<?= $this->render('_form', [
        'model' => $model,'cityModel'=>$cityModel,'cityList'=>$cityList
    ]) ?>
    
</div>
