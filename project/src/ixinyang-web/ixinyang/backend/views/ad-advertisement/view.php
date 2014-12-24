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
                'attribute'=>'photoUrl',
                'format'=>'raw',  
                'value'=> "<img src=".$model->photoUrl." width='400px'; />",
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
