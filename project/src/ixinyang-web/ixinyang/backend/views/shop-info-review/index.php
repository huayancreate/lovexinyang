<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use backend\models\ShopInfoReview;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Info Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-index">
    <p>
           <?= Html::a('分店申请','javascript:void(0);', ['id'=>'btnAdd','class' => 'btn btn-success']) ?>
             <!-- <?= Html::a('分店申请', Yii::$app->urlManager->createUrl(['shop-info-review/create']),
                                [
                                 //'title' => Yii::t('yii', '结款审核'),
                                 'data-pjax' => '0',
                                 'data' => [
                                      'method' => 'post',
                                    ],
                                 'class' => 'btn btn-success'
                                ]
                        )
             ?> -->
    </p>
    <br/>
<?php \yii\widgets\Pjax::begin(['id'=>'gridList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'shopName',
            'contact',
            'address',
            'businessHours',
            [
                'attribute' => 'auditState',
                'label'=>'状态',
                'value'=>
                    function($model){
                        return ShopInfoReview::getState($model['auditState']);
                    },
            ],
            [
                'attribute' => 'Rejection',
                'value'=>
                    function($model){
                        return !empty($model['Rejection']) ? $model['Rejection']: "";
                    },
            ],
            
            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function($url,$model){
                        return Html::a('<span class="glyphicon  glyphicon-eye-open"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                                'onClick'=>'getView("'.$model['shopName'].'","shop-info-review/view&id='.$model['id'].'")'
                            ]);
                    },
                    'update'=>function($url,$model){
                       /* return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '修改'),
                                'onClick'=>'getEdit("shop-info-review/update&id='.$model['id'].'","shopinforeviewFrom","gridList","修改")'
                            ]);*/
                    },
                    'delete'=>function($url,$model){
                        if ($model['auditState']==3 || $model['auditState']==5) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0)',
                                [
                                    'title' => Yii::t('yii', '删除'),
                                    'onClick'=>'expurgate("shop-info-review/delete&id='.$model['id'].'")'
                                ]);
                        }
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
        /*var url="shop-info-review/create";
        JuiDialog.dialog("dialogId","分店申请",url,"shopinforeviewFrom","gridList");*/

         //加载店铺申请信息
            getCreateInfo();
            $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                            autoOpen:false,
                            modal: true,
                            title:"分店申请",
                            show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                            hide: "explode",       //hide:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                            resizable: true,
                            overlay: {
                                opacity: 0.5,
                                background: "black",
                                overflow: 'auto'
                            },
                        buttons: {
                         
                        },
                        close: function () {
                            $("#dialogId").dialog("close");
                        },  
            });
    });
});

//弹出dialog 添加对话框
function getCreateInfo(){
     $.ajax({
         type:"post",
         url:"index.php?r=shop-info-review/create",
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

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
<?php 
$this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END);
?>