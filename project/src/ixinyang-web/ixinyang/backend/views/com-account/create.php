<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use backend\models\ComRole;
use backend\models\ComPersonRolerelation;


/* @var $this yii\web\View */
/* @var $model backend\models\ComAccount */

$this->title = '录入新工号';
$this->params['breadcrumbs'][] = '账号管理';
?>

<div class="row">
    <div class="com-account-create">

        <?= $this->render('_form', [
            'model' => $model, 'role' => $role, 'roles' => $roles, 'roleId' => 0,
        ]) ?>
    </div>
</div>
