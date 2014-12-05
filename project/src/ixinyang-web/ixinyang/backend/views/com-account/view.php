<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ComAccount */

$this->title = $model->nickname;
$this->params['breadcrumbs'][] = ['label' => '账号管理', 'url' => ['create']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-account-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userName',
            'nickname',
            'sex',
            'phoneNumber',
            [
                'attribute'=>'角色',
                'format'=>'raw',   
                'value' =>$role->roleName,          
            ],
            'email:email',
            'address',
            [
                'attribute'=>'accountStatus',
                'format'=>'raw',   
                'value' =>$model->accountStatus==1?'有效':'无效',  
            ],
            [
                'attribute'=>'isFirstLogin',
                'format'=>'raw',   
                'value' =>$model->isFirstLogin==1?'是':'否',  
            ],
            'createTime', 
            'updateTime',
        ],
    ]) ?>

</div>
