<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\GoodsApplyInfo */

$this->title = 'Create Goods Apply Info';
$this->params['breadcrumbs'][] = ['label' => 'Goods Apply Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-apply-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
