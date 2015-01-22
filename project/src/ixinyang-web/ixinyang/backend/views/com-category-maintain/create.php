<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComCategoryMaintain */

$this->title = '创建类别';
?>
<div class="com-category-maintain-create">
    <?= $this->render('_form', [
        'model' => $model,
        'category'=>$category,
    ]) ?>

</div>
