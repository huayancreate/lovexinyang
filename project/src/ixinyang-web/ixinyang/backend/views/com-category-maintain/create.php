<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComCategoryMaintain */

$this->title = '创建类别';
?>
<div class="com-category-maintain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category'=>$category,
    ]) ?>

</div>
