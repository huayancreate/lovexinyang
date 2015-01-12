<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComMessageBox */

$this->title = 'Update Com Message Box: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Com Message Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="com-message-box-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
