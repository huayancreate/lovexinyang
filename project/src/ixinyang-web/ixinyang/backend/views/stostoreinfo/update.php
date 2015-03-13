<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StoStoreInfo */

$this->title = 'Update Sto Store Info: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sto Store Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sto-store-info-update">

<!--     <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,'categoryModel'=>$categoryModel,'categoryList'=>$categoryList,
        'category'=>$category
    ]) ?>

</div>
