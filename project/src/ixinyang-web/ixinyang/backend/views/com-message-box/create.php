<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComMessageBox */

$this->title = 'Create Com Message Box';
$this->params['breadcrumbs'][] = ['label' => 'Com Message Boxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-message-box-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
