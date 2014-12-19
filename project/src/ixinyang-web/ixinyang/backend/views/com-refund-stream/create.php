<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComRefundStream */

$this->title = 'Create Com Refund Stream';
$this->params['breadcrumbs'][] = ['label' => 'Com Refund Streams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-refund-stream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
