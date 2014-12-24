<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ComCategoryMaintain;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

   <!--  <p>
        <?= Html::a('新增店铺信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php \yii\widgets\Pjax::begin(['id'=>'stostoreinfoList']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'storeName',
        'storeAddress',
        [
            'attribute' => 'auditState',
            'label'=>'店铺类别',
            'value'=>
                function($model){
                    return ComCategoryMaintain::findOne($model->storeType)->categoryName;
            },
        ],
        'contactWay',
        'businessHours',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttons'=>[
                'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "javascript:void(0)",
                    [
                        'title' => Yii::t('yii', '修改'),
                        'onClick'=>'getEdit("stostoreinfo/update&id='.$model->id.'","stostoreinfoFrom","stostoreinfoList","修改")'
                    ]);
                },
            ],
        ],
    ],
]); ?>
<?php \yii\widgets\Pjax::end(); ?>
