<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoStoreInfo */

$this->title = 'Create Sto Store Info';
$this->params['breadcrumbs'][] = ['label' => 'Sto Store Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sto-store-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
