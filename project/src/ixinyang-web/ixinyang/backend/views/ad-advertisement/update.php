<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ad */

$this->title = 'Update Ad: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-update">

    <?= $this->render('_form', [
        'model' =>$model,
        'dictionaryModel'=>$dictionaryModel,
        'dictionaryList'=>$dictionaryList,
    ]) ?>

</div>
