<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCategoryMaintain */

$this->title = '修改类别: ' . ' ' . $model->categoryName;
$this->params['breadcrumbs'][] = ['label' => '类别维护', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->categoryName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="com-category-maintain-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category,
    ]) ?>

</div>
