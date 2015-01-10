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
     <?= $form->field($model, 'ad_advertisement')->inline()->radioList(['1'=>'商品','2'=>'店铺'])?>
     <?= $form->field($model, 'ad_recommend_goods')->textInput() ?>
    <input type="hidden" id="project-id" name="project-id">

     <?= 
            $form->field($model,'startDate')->widget(
            DatePicker::className(),[
                    'language' => 'zh-CN',
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

   <div class="col-lg-7">
    <div class="form-group pull-right">
       <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
   </div>
   </div>
    <?php ActiveForm::end(); ?>

</div>

<script type="text/JavaScript">
$(function(){
     //页面初始加载执行加载数据
     loadGoodsOrStoreInfo();

    $("input[name='AdRecommendGoods[ad_advertisement]']").change(function(){
        ////商品 店铺选择的切换  加载商品或店铺信息
        loadGoodsOrStoreInfo();
    }); 

    //开始日期变动 若结束日期小于开始日期  则给结束日期赋值:开始日期
       $("#adrecommendgoods-startdate").change(function(){
            var applyTimeStartValue=$("#adrecommendgoods-startdate").val();
            var applyTimeEndValue=$("#adrecommendgoods-enddate").val();
            var days = DateDiff(applyTimeEndValue,applyTimeStartValue); 
            if (days<0) {
              $("#adrecommendgoods-enddate").val(applyTimeStartValue);
            };
         });
       //结束日期变动 若结束日期小于开始日期  则给开始日期赋值:结束日期
       $("#adrecommendgoods-enddate").change(function(){
            var applyTimeStartValue=$("#adrecommendgoods-startdate").val();
            var applyTimeEndValue=$("#adrecommendgoods-enddate").val();
            var days = DateDiff(applyTimeEndValue,applyTimeStartValue); 
            if (days<0) {
              $("#adrecommendgoods-startdate").val(applyTimeEndValue);
            };
         });
});

//type  1  加载商品     2  加载店铺
function loadData(source,type){
    $( "#adrecommendgoods-ad_recommend_goods" ).autocomplete({
        minLength: 0,
        source: source,
        focus: function( event, ui ) {
        $( "#adrecommendgoods-ad_recommend_goods" ).val( type==1  ? ui.item.goodsName + "-"+ ui.item.storeName : ui.item.storeName );
        return false;
    },
    select: function( event, ui ) {

      var selectStr=type==1  ? ui.item.goodsName + "-" + ui.item.storeName : ui.item.storeName;

           $( "#adrecommendgoods-ad_recommend_goods" ).val(selectStr);
           $( "#project-id" ).val( ui.item.id);
            return false;
        }
    })
    .autocomplete( "instance" )._renderItem = function( ul, item ) {

      var showStr=type==1 ? item.goodsName + '-' + item.storeName : item.storeName;

        return $( "<li>" )
        .append( "<a>" + showStr + "</a>" )
        .appendTo( ul );
    };
}

  //商品 店铺选择的切换  加载商品或店铺信息
    function loadGoodsOrStoreInfo(){
      //1 商品  2 店铺
        if ($("input[name='AdRecommendGoods[ad_advertisement]']:checked").val()=="1") {
            $( "#adrecommendgoods-ad_recommend_goods" ).val('');
            loadData(<?=$jsonStoGoods?>,1);
        }
        else{
            $("#adrecommendgoods-ad_recommend_goods" ).val('');
            loadData(<?=$jsonStoreInfo?>,2);
        }
    }
//d1 d2都是日期参数
    function DateDiff(d1,d2){ 
    var day = 24 * 60 * 60 *1000; 
    try{     
          var dateArr = d1.split("-"); 
          var checkDate = new Date(); 
          checkDate.setFullYear(dateArr[0], dateArr[1]-1, dateArr[2]); 
          var checkTime = checkDate.getTime(); 

          var dateArr2 = d2.split("-"); 
          var checkDate2 = new Date(); 
          checkDate2.setFullYear(dateArr2[0], dateArr2[1]-1, dateArr2[2]); 
          var checkTime2 = checkDate2.getTime(); 

          var cha = (checkTime - checkTime2)/day;   
          return cha; 
    }
    catch(e){ 
          return false; 
      } 
    }
    //加几天 date->日期  days->天数
    function AddDays(date,days){ 
      var nd = new Date(date); 
      nd = nd.valueOf(); 
      nd = nd + days * 24 * 60 * 60 * 1000; 
      nd = new Date(nd); 
      //alert(nd.getFullYear() + "年" + (nd.getMonth() + 1) + "月" + nd.getDate() + "日"); 
      var y = nd.getFullYear(); 
      var m = nd.getMonth()+1; 
      var d = nd.getDate(); 
      if(m <= 9) m = "0"+m; 
      if(d <= 9) d = "0"+d; 
      var cdate = y+"-"+m+"-"+d; 
      return cdate; 
    }

  

</script>