<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CusConsumptionRecords */

$this->title = 'Update Cus Consumption Records: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cus Consumption Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'verifierTime' => $model->verifierTime]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cus-consumption-records-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
