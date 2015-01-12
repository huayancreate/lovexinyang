<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoSellerInfo */

$this->title = 'Update Sto Seller Info: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sto Seller Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sto-seller-info-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
