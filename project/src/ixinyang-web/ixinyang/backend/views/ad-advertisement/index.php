<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*$this->title = '页头广告设置';
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="ad-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

  <?=
     yii\bootstrap\Tabs::widget([
      'items' => [
          [
              'label' => '页头广告设置',
              'content' => '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                        $this->render('list', ['dataProvider' => $dataProvider,])
                    ."</div>",
              'active' => true
          ],
          [
                'label' => '商品推荐',
                'content' => '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                        $this->render('../ad-recommend-goods/index', ['dataProvider' => $dataProviderRecGoods,])
                    ."</div>",
              
          ],
      ],
  ]);
  ?>

</div>

<!-- 商品推荐-->
<div id="showRecomGoodsDiv">
   
</div>

<!-- 弹出框-->
<?php 
    Dialog::begin([
        'id'=>'dialogId',
        'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width'=>'600',
            'height'=>'600',
            'resizable'=> true,
        ],
    ]);
?>    

<?php
    Dialog::end();
?>


<script type="text/javascript">

<?php $this->beginBlock('JS_END'); ?>

//页面初次加载执行加载推荐商品画面
/*if (window.attachEvent) {
      window.attachEvent("onload", loadRecomGoodsInfo);//IE
  }
  else {
      window.addEventListener("load", loadRecomGoodsInfo, false);//FF
  }
  function loadRecomGoodsInfo()
  {
    $.ajax({
           type:"post",
           url:"index.php?r=ad-recommend-goods/index",
           success:function(data) {
             $("#showRecomGoodsDiv").html(data);
           }
         });
  }*/

  function addAd(){
     var url="ad-advertisement/create";
     JuiDialog.dialog("dialogId","广告添加",url,"advertisementForm","adGridList");
  }


    
<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>