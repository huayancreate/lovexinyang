<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */

$this->title = 'Create Sto Goods';
$this->params['breadcrumbs'][] = ['label' => 'Sto Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
