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
use backend\models\StoGoodsStore;
use backend\models\StoGoods;
use backend\models\GoodsPicture;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\StoGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sto Goods';
$this->params['breadcrumbs'][] = $this->title;
$this->assetBundles['cliff363825\kindeditor\KindEditorWidget'] = new yii\web\AssetBundle;
?>
<div class="sto-goods-index">
   
    <p>
    <div class="line-height">
        <?= Html::a('商品添加','javaScript:void(0)', ['id'=>'btnAdd','class' => 'btn btn-success']) ?>
        <?= Html::a('其他店铺商品复制','javaScript:void(0)', ['id'=>'btnOtherStoreGoodsCopy','class' => 'btn btn-success']) ?>
    </div>
    </p>

<?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'id'=>'gridList',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                'label'=>'商品图片',
                'format'=>'html',
                'value'=>function($model){
                    $showStr='';
                    $goodsPictureModels=GoodsPicture::find()->where(['goodsId' =>$model['goodsId']])->all();
                    if (!empty($goodsPictureModels) ) {
                        foreach ($goodsPictureModels as $goodsPictureModel) {
                           $showStr=$showStr."<img src=".$goodsPictureModel['path']." width='50px'; />";
                        }
                    }
                   
                    return $showStr;
                }
            ],
             [
                'label'=>'商品名称',
                'value'=>
                    function($model){
                        $goodsModel=StoGoods::findOne($model['goodsId']);
                        return !empty($goodsModel) ?  $goodsModel->goodsName: '';
                },
            ],
            
            [
                'label'=>'商品库存',
                'value'=>
                    function($model){
                        
                        return  $model['inventory'];
                },
            ],
            [
                'label'=>'商品价格',
                'value'=>
                    function($model){
                        $goodsModel=StoGoods::findOne($model['goodsId']);
                        return !empty($goodsModel) ? $goodsModel->price : '';
                },
            ],
           
            [
                'label'=>'商品状态',
                'value'=>
                    function($model){
                       return StoGoodsStore::getGoodsState($model['goodsState']);
                },
            ],
           
            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'120'],
                'template' => '{update} {publish} {delete} {shelves} ',
                'buttons'=>[
                    'update'=>function($url,$model){
                    return Html::a('修改', "javascript:void(0)",
                        [
                            'title' => Yii::t('yii', '修改'),
                            'onClick'=>'getEdit("sto-goods/update&sgsId='.$model['sgsId'].'&goodsId='.$model['goodsId'].'","goodsFrom","gridList","修改")'
                        ]);
                    },
                    'publish'=>function($url,$model){
                        if ($model['goodsState']==0 || $model['goodsState']==2 ) {
                             return Html::a('发布',
                              Yii::$app->urlManager->createUrl(['sto-goods/listpublish','sgsId' => $model['sgsId']]),
                                [
                                 'title' => Yii::t('yii', '发布'),
                                 'data-pjax' => '0',
                                 'data' => [
                                      'confirm' => '确定发布该商品吗?',
                                      'method' => 'post',
                                    ]
                                ]);
                            } 
                    },
                    'delete'=>function($url,$model){
                        if ($model['goodsState']==0 || $model['goodsState']==2 ) {
                           /*  return Html::a('删除', 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', '删除'),
                                        'onClick'=>'expurgate("sto-goods/delete&sgsId='.$model['sgsId'].'&goodsState='.$model['goodsState'].'&goodsId='.$model['goodsId'].'")'
                                    ]);*/

                              return  Html::a('删除', ['delete', 'sgsId' => $model['sgsId'],'goodsState'=>$model['goodsState'],'goodsId'=>$model['goodsId']], [
                                            'data' => [
                                                'confirm' => '您确定删除此商品吗?',
                                                'method' => 'post',
                                            ],
                                      ]); 
                        }
                   
                    },
                    'shelves'=>function($url,$model){
                         if ($model['goodsState']==1){
                             return  Html::a('下架', ['goodsshelves', 'sgsId' => $model['sgsId']], [
                                            'data' => [
                                                'confirm' => '您确定让此商品下架吗?',
                                                'method' => 'post',
                                            ],
                                      ]); 
                            }
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
            'width'=>'50%',
            'height'=>'750',
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

        $("#btnOtherStoreGoodsCopy").click(function(){
            var url="sto-goods/otherstoregoodslist";
            JuiDialog.getPage("dialogId",url);
            JuiDialog.show("dialogId");
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

<?php
    $this->registerCssFile(Yii::$app->urlManager->baseUrl . '/assets/666a7a9f/css/kv-widgets.css', []);
?>

<style type="text/css">
.line-height{
    line-height:40px;
  }
</style>