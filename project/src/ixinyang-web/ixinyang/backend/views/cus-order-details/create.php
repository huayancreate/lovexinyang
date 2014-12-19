<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CusOrderDetails */

$this->title = 'Create Cus Order Details';
$this->params['breadcrumbs'][] = ['label' => 'Cus Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-order-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
