<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ad */

?>
<div class="ad-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'adType',
                'format'=>'raw',  
                'value'=> $model->adType==1 ? "手机端": "web端",
            ],
            [
                'attribute'=>'photoUrl',
                'format'=>'raw',  
                'value'=> "<img src=".$model->photoUrl." width='400px'; />",
            ],
            [
                'attribute'=>'mapLocation',
                'format'=>'raw',  
                'value'=> !empty($comdicModel)? $comdicModel->categoryName: "",
            ],
            'adName',
            'startDate',
            'endDate',
            'createTime',
            'mapLink',
            'mapOrder',
            'mapLocation',
            'updateTime',
            
            [
                'attribute'=>'isValid',
                'format'=>'raw',  
                'value'=> $model->isValid==1 ? "有效" : "无效",
            ],

        ],
    ]) ?>

</div>
