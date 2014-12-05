<?php

use yii\helpers\Html;
use backend\models\ComPersonRolerelation;

/* @var $this yii\web\View */
/* @var $model backend\models\ComAccount */

$this->title = '修改员工信息 ';
$this->params['breadcrumbs'][] = ['label' => '账号管理', 'url' => ['create']];
$this->params['breadcrumbs'][] = ['label' => $model->nickname, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-account-update">

    <h4><?= Html::encode($this->title) ?></h4>
      
    <?= $this->render('_form', [
        'model' => $model,'role'=>$role,'roles'=>$roles,
        'roleId'=>$roleId,
    ]) ?>
  
</div>

