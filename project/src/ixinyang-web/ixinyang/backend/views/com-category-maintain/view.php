<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ComCategoryMaintain;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCategoryMaintain */

$this->title = $model->categoryName;
$this->params['breadcrumbs'][] = ['label' => '类别维护', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-category-maintain-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'categoryCode',
            'categoryName',
            [
                'attribute'=>'categoryType',
                'format'=>'raw',
                'value' =>$model->categoryType=='1'?'商品类别':'评价类别',
            ],
            [
                'attribute'=>'parentCategoryId',
                'format'=>'raw',
                'value'=>$category->categoryName,

                //'value' =>$category->categoryName==""?"无":"有",
            ],

            'categoryAttribute',
            'categoryFeature',
            'categoryGrade',
            'updateTime',
            [
                'attribute'=>'isValid',
                'format'=>'raw',
                'value' =>$model->isValid=='1'?'有效':'无效',
            ],
            'sort',
        ],
    ]) ?>

</div>
