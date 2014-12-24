<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CusVerificationCode */

$this->title = 'Update Cus Verification Code: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cus Verification Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cus-verification-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
