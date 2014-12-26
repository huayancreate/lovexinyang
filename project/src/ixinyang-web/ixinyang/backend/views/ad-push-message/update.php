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

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
