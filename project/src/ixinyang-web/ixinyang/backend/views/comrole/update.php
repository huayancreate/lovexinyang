<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\com_role */

$this->title = 'Update Com Role: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Com Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="com-role-update">

    <?= $this->render('_form', [
        'model' => $model,'treeData'=>$treeData,
    ]) ?>

</div>
