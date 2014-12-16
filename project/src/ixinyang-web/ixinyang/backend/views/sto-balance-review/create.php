<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoBalanceReview */

$this->title = 'Create Sto Balance Review';
$this->params['breadcrumbs'][] = ['label' => 'Sto Balance Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-balance-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
