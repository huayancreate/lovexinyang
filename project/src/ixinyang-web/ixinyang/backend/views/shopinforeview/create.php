<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */

$this->title = 'Create Shop Info Review';
$this->params['breadcrumbs'][] = ['label' => 'Shop Info Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-create">
    <?= $this->render('_form', [
        'model' => $model,'cityModel'=>$cityModel,'cityList'=>$cityList,
                'countyList'=>$countyList,'countyModel'=>$countyModel,
                'busidistList'=>$busidistList,'busidistModel'=>$busidistModel,
    ]) ?>

</div>
