<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundReview */

$this->title = 'Update Com Refund Review: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Com Refund Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="com-refund-review-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
