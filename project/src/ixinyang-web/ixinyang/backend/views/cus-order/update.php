<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CusOrder */

$this->title = 'Update Cus Order: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cus Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cus-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
