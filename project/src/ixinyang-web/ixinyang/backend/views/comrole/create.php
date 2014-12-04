<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\com_role */

$this->title = '角色新增';
$this->params['breadcrumbs'][] = ['label' => '角色新增', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-role-create">

    <?= $this->render('_form', [
        'model' => $model,'treeData'=>$treeData,
    ]) ?>

</div>
