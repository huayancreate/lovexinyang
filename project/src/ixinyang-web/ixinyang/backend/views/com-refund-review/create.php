<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundReview */

$this->title = 'Create Com Refund Review';
$this->params['breadcrumbs'][] = ['label' => 'Com Refund Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
