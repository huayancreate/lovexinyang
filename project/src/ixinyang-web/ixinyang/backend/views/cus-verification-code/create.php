<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CusVerificationCode */

$this->title = 'Create Cus Verification Code';
$this->params['breadcrumbs'][] = ['label' => 'Cus Verification Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-verification-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
