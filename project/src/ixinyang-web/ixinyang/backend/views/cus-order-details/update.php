<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrderDetails */

$this->title = 'Update Cus Order Details: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cus Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cus-order-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
