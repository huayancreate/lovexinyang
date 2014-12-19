<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CusOrder */

$this->title = 'Create Cus Order';
$this->params['breadcrumbs'][] = ['label' => 'Cus Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
