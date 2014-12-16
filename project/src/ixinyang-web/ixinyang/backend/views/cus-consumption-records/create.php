<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CusConsumptionRecords */

$this->title = 'Create Cus Consumption Records';
$this->params['breadcrumbs'][] = ['label' => 'Cus Consumption Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-consumption-records-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
