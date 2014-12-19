<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundStream */

$this->title = 'Update Com Refund Stream: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Com Refund Streams', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="com-refund-stream-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
