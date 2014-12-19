<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\StoStoreInfo;
use backend\models\StoGoodsStore;
use backend\models\StoGoods;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdRecommendGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*$this->title = '商品推荐';
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="ad-recommend-goods-index">
 <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <p>
        <?= Html::button( '添加', ['class' => 'btn btn-success','id'=>'btnRecGoodsAdd','onclick'=>"addRecGoods()"]) ?>
    </p>

<?php \yii\widgets\Pjax::begin(['id'=>'recomGoodGridList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'ad_advertisement',
                'value'=>function($data){

                  return $data['ad_advertisement']==1 ? "商品": "店铺";
                }
            ],
            [
                'attribute'=>'ad_recommend_goods',
                
                'value'=>function($data){
                    if ($data['ad_advertisement']==1) {//商品
                        //在商品对应店铺信息表中 根据商品id查询店铺id
                         $goodsStoreModel=StoGoodsStore::find()->where(['goodsId'=>$data['ad_recommend_goods']])->one();
                        if (!empty($goodsStoreModel)) {
                            //根据店铺id查询店铺名称
                             $stoStoreInfoModel=StoStoreInfo::find()->where(['id'=>$goodsStoreModel->storeId])->one();
                             if (!empty($stoStoreInfoModel)) {
                                //根据商品id  到商品表中查询商品名称
                                $stoGoodsModel=StoGoods::find()->where(['id'=>$data['ad_recommend_goods']])->one();
                                 if (!empty($stoGoodsModel)) {
                                     return $stoGoodsModel->goodsName.'-'.$stoStoreInfoModel->storeName;
                                 }
                                 else{
                                     return '';
                                 }
                             }
                                
                         }
                          else{
                              return '';
                          }
                         
                    }
                    else{//店铺

                         $stoStoreInfoModel=StoStoreInfo::find()->where(['id'=>$data['ad_recommend_goods']])->one();
                         
                         if (!empty($stoStoreInfoModel)) {
                                return $stoStoreInfoModel->storeName;
                         }
                          else{
                              return '';
                          }
                    }
                }
            ],
            'order',
             [
                'attribute'=>'isValid',
                'value'=>function($data){
                  
                  return $data['isValid']==1 ? "有效": "无效";
                }
            ],

            ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
                'buttons'=>[

                        'view'=>function(){
                             
                            },
                        'update'=>function(){

                        },

                        'delete'=>function($url,$model){
                             if ($model['isValid']=='1') {
                               return Html::a('置为无效',
                              Yii::$app->urlManager->createUrl(['ad-recommend-goods/delete','id' => $model['id']]),
                                [
                                 'title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                 'data' => [
                                      'confirm' => '确定要将该推荐商品置为无效吗?',
                                      'method' => 'post',
                                    ]
                                ]
                                );
                           }
                        },

                 ]
           ],
        ],
    ]); ?>

<?php \yii\widgets\Pjax::end(); ?>
</div>

 <script type="text/javascript">

<?php $this->beginBlock('JS_END2'); ?>

 function addRecGoods(){
     var url="ad-recommend-goods/create";
     JuiDialog.dialog("dialogId","商品推荐添加",url,"recommendGoodsForm","recomGoodGridList");
  }
    
<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END2'], \yii\web\View::POS_END); ?> 
 