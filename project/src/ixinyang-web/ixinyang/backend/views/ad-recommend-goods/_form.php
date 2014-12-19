<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\AdRecommendGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-recommend-goods-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'recommendGoodsForm']); ?>

    <?= $form->field($model, 'ad_advertisement')->inline()->radioList(['1'=>'商品','2'=>'店铺'],['name'=>'recomGoodsType'])?>
    
    <div class="form-group field-adrecommendgoods-ad_recommend_goods">
        <label class="control-label col-sm-3" for="adrecommendgoods-ad_recommend_goods">对应名称</label>
        <div class="col-sm-6">
            <input id="adrecommendgoods-ad_recommend_goods" type="text" >
            <div class="help-block help-block-error "></div>
        </div>
    </div>
    <input type="hidden" id="project-id" name="project-id">

     <?= 
            $form->field($model,'startDate')->widget(
            DatePicker::className(),[
                    'language' => 'zh-CN',
                    'id'  => 'startDate',
                    'name'  => 'startDate',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' =>
                    [//写属性
                        'inline'=>true,
                        'changeMonth' => true,
                    ],
                   ])
       ?>

    
      <?= 
        $form->field($model,'endDate')->widget(
        DatePicker::className(),[
                'language' => 'zh-CN',
                'id'  => 'endDate',
                'name'  => 'endDate',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' =>
                [//写属性
                    'inline'=>true,
                    'changeMonth' => true,
                ],
               ])
      ?>

    <?= $form->field($model, 'order')->textInput() ?>

    <?= $form->field($model, 'isValid')->checkbox() ?>

    <!-- <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
     -->
    <?php ActiveForm::end(); ?>

</div>

<script type="text/JavaScript">
$(function(){
    $("input[name='recomGoodsType']").change(function(){
        //1 商品  2 店铺
        if ($('input[name="recomGoodsType"]:checked').val()=="1") {
            $( "#adrecommendgoods-ad_recommend_goods" ).val('');
            loadData(<?=$jsonStoGoods?>,1);
        }
        else{
            $("#adrecommendgoods-ad_recommend_goods" ).val('');
            loadData(<?=$jsonStoreInfo?>,2);
        }

    }); 
});

//type  1  加载商品     2  加载店铺
function loadData(source,type){
    $( "#adrecommendgoods-ad_recommend_goods" ).autocomplete({
        minLength: 0,
        source: source,
        focus: function( event, ui ) {
        $( "#adrecommendgoods-ad_recommend_goods" ).val( type==1  ? ui.item.goodsName : ui.item.storeName );
        return false;
    },
    select: function( event, ui ) {
           $( "#adrecommendgoods-ad_recommend_goods" ).val( type==1  ? ui.item.goodsName : ui.item.storeName );
           $( "#project-id" ).val( ui.item.id);
            return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li>" )
        .append( "<a>" + type==1 ? item.goodsName : item.storeName + "</a>" )
        .appendTo( ul );
    };
}
</script>