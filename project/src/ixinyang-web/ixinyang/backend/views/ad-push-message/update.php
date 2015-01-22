<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AdPushMessage */

$this->title = 'Update Ad Push Message: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ad Push Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ad-push-message-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
