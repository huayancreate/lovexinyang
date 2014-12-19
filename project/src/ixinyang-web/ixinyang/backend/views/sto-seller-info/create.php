<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoSellerInfo */

$this->title = 'Create Sto Seller Info';
$this->params['breadcrumbs'][] = ['label' => 'Sto Seller Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-seller-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
