<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Info Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-index">
    <p>
        <?= Html::a('分店申请','javascript:void(0);', ['id'=>'btnAdd','class' => 'btn btn-success']) ?>
    </p>
<?php \yii\widgets\Pjax::begin(['id'=>'gridList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'city',
            //'longitude',
            //'latitude',
            'shopName',
            'contact',
            // 'regional',
            // 'storeId',
            // 'storeAccount',
            // 'businessDistrictId',
            'address',
            'businessHours',
            // 'storeOutline:ntext',
            // 'cityId',
            // 'countyId',
            // 'applyTime',
            // 'applyUserId',
            // 'applyUserName',
            // 'auditUserId',
            // 'auditUserName',
            // 'auditTime:datetime',
            // 'managerId',
            // 'managerName',
            // 'managerTime:datetime',
            [
                'attribute' => 'auditState',
                'label'=>'状态',
                'value'=>
                    function($model){
                        return $model->getState($model->auditState);
                    },
            ],
            // 'Rejection',

            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function($url,$model){
                        return Html::a('<span class="glyphicon  glyphicon-eye-open"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                                'onClick'=>'getView("'.$model->shopName.'","shopinforeview/view&id='.$model->id.'")'
                            ]);
                    },
                    'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "javascript:void(0)",
                        [
                            'title' => Yii::t('yii', '修改'),
                            'onClick'=>'getEdit("shopinforeview/update&id='.$model->id.'","shopinforeviewFrom","gridList","修改")'
                        ]);
                    },
                    'delete'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0)',
                        [
                            'title' => Yii::t('yii', '删除'),
                            'onClick'=>'expurgate("shopinforeview/delete&id='.$model->id.'")'
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end(); ?>
</div>
<?php 
    Dialog::begin([
        'id'=>'dialogId',
        'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width'=>'500',
            'height'=>'550',
            'resizable'=> true,
        ],
    ]);
?>    

<?php
    Dialog::end();
?>

<script type="text/javascript"> 

<?php $this->beginBlock('JS_END'); ?>



$(function(){
    $("#btnAdd").click(function(){
        var url="shopinforeview/create";
        JuiDialog.dialog("dialogId","分店申请",url,"shopinforeviewFrom","gridList");
    });
});

function getView(title,url){
    JuiDialog.dialogView("dialogId",title,url);
}

function getEdit(url,fromId,gridId,title){
    JuiDialog.dialog("dialogId",title,url,fromId,gridId);
}
function expurgate(url){
    if(confirm("确定要删除数据吗")){
        JuiDialog.del(url,"gridList");
    }
}

<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>