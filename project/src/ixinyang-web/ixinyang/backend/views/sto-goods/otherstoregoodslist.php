<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use yii\bootstrap\ActiveForm;
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
<div class="sto-goods-otherstoregoodslist">
<?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'id'=>'otherstoregoodsList',
        'dataProvider' => $dataProvider,
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
                'format'=>'raw',
                'value'=>
                    function($model){
                        return Html::input('text','inventory_'.$model['sgsId'].'');
                },
            ],
            [
                'label'=>'是否享受折扣',
                'format'=>'raw',
                'value'=>
                    function($model){
                         return Html::input('checkbox','enjoyRebate_'.$model['sgsId'].'');
                     
                },
            ],
           
            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'120'],
                'template' => '{copy} ',
                'buttons'=>[
                    'copy'=>function($url,$model){
                    return Html::a('复制', "javascript:void(0)",
                        [
                            'title' => Yii::t('yii', '复制'),
                            //'onClick'=>'copyOtherStoGoods('.$model['sgsId'],$model['goodsId'],$model['sellerId'].')'
                        'onClick'=>'copyOtherStoGoods('.$model['sgsId'].','.$model['goodsId'].','.$model['sellerId'].')'
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end(); ?>

</div>

<script type="text/javascript">
    function copyOtherStoGoods(sgsId,goodsId,sellerId){  
        
       //商品库存 
       var inventory=$("input[name='inventory_"+sgsId+"']").val();
       //是否享受会员折扣  默认是0
       var isChecked=0;
       if ($("#enjoyRebate_"+sgsId+"").is(':checked')) {
          //选择则为1
          isChecked=1;
       }

        $.ajax({
        type:"POST",
        url:"index.php?r=sto-goods/otherstoregoodscopy",
        data:{sgsId:sgsId,inventory:inventory,enjoyRebate:isChecked,goodsId:goodsId,sellerId:sellerId},
        dataType:'json',
        error: function (request) {
           alert("Connection error");
        },
        success:function(data) {
            if(data.success){
             //当成功后操作。。
             alert('复制成功');
             //$("#dialogId").dialog("close");
             $.pjax.reload({container:'#gridList'});  //刷新你的gridview  id
            }else{
             alert('复制失败,请重试');
            }
        }
      });
    }
</script>

<style type="text/css">
.line-height{
    line-height:40px;
  }
</style>