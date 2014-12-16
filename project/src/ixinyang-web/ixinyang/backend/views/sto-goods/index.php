<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use yii\web\Url;
use cliff363825\kindeditor\KindEditorWidget;
use backend\models\ComCategoryMaintain;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sto Goods';
$this->params['breadcrumbs'][] = $this->title;
$this->assetBundles['cliff363825\kindeditor\KindEditorWidget'] = new yii\web\AssetBundle;
?>
<link href="/ixinyang/backend/web/assets/fcd10d88/css/kv-widgets.css" rel="stylesheet">

<div class="sto-goods-index">

    <?php $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('商品添加','javaScript:void(0)', ['id'=>'btnAdd','class' => 'btn btn-success']) ?>
    </p>
<?php \yii\widgets\Pjax::begin(['id'=>'gridList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'goodsName',
            //'summary',
            //'describes',
            'price',
            [
                'attribute' => 'subClass',
                'label'=>'商品类别',
                'value'=>
                    function($model){
                        return "商品类别";//ComCategoryMaintain::findOne($model->subClass)->categoryName;
                },
            ],
            // 'validity',
            // 'supplyDateTime',
            // 'enjoyRebate',
            // 'goodsGrade',
            // 'goodsWeight',
            // 'goodsState',
            // 'createDate',
            // 'createID',
            // 'createName',
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete} ',
                'buttons'=>[
                    // 'view'=>function($url,$model){
                    //     return Html::a('查看', "javascript:void(0)",
                    //         [
                    //             'title' => Yii::t('yii', '查看'),
                    //             'data-pjax' => '0',
                    //             'onClick'=>'getView("'.$model->goodsName.'","sto-goods/view&id='.$model->id.'")'
                    //         ]);
                    // },
                    'update'=>function($url,$model){
                    return Html::a('修改', "javascript:void(0)",
                        [
                            'title' => Yii::t('yii', '修改'),
                            'onClick'=>'getEdit("sto-goods/update&id='.$model->id.'","goodsFrom","gridList","修改")'
                        ]);
                    },
                    // 'goodsPicture'=>function($url,$model){
                    // return Html::a('图片管理', 'javascript:void(0)',
                    //     [
                    //         'title' => Yii::t('yii', '删除'),
                    //         'onClick'=>'expurgate("sto-goods/delete&id='.$model->id.'")'
                    //     ]);
                    // },
                    'delete'=>function($url,$model){
                    return Html::a('删除', 'javascript:void(0)',
                        [
                            'title' => Yii::t('yii', '删除'),
                            'onClick'=>'expurgate("sto-goods/delete&id='.$model->id.'")'
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end(); ?>

<?php 
    Dialog::begin([
        'id'=>'dialogId',
        'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width'=>'95%',
            'height'=>'550',
            'resizable'=> true,
        ],
    ]);
?>    

<?php
    Dialog::end();
?>
</div>

<script type="text/javascript"> 

<?php $this->beginBlock('JS_END'); ?>

    $(function(){
        $("#btnAdd").click(function(){
            var url="sto-goods/create";
            JuiDialog.getPage("dialogId",url);
            JuiDialog.show("dialogId");
            //JuiDialog.dialog("dialogId",'商品新增',url,"goodsFrom","gridList");
        });
    });

    function getView(title,url){
        JuiDialog.dialogView("dialogId",title,url);
    }

    function getEdit(url,fromId,gridId,title){
        JuiDialog.getPage("dialogId",url);
        JuiDialog.show("dialogId");
        //JuiDialog.dialog("dialogId",title,url,fromId,gridId);
    }

    function expurgate(url){
        if(confirm("确定要删除数据吗?确定将不可恢复！")){
            JuiDialog.del(url,"gridList");
        }
    }

<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>