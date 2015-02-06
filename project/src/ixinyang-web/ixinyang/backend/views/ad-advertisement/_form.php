<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;
use kartik\widgets\FileInput;
use backend\models\Ad;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Ad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-form">


    <?php $form = ActiveForm::begin([
      'id'=>'advertisementForm',
      'layout' => 'horizontal',
      'options' => ['enctype' =>'multipart/form-data'],
    ]); ?>

 <div class="row">
 <div class="col-lg-12">
     <?= $form->field($model, 'adType')->inline()->radioList(['1'=>'手机端','2'=>'web端'])?>
      <div id="phoneDiv" >
          <?= $form->field($model,'file')->widget(
            FileInput::className(),[
                'options'=>[
                    'multiple' => false,
                    'value'=>$model->photoUrl,
                ],
                'pluginOptions'=>[
                    'initialPreview'=>Ad::getPicture($model->id),
                    'previewFileType' => 'any',
                    'showUpload'=>false,
                    'browseLabel'=>'浏览文件',
                    'removeLabel'=>'移除文件',
                    'initialCaption'=>"请选择上传文件",
                    'overwriteInitial'=>true,
                ],

            ])->label("广告图片")?>
        </div>

         <div id="webDiv" style="display:none">
          <?= $form->field($model,'fileWeb')->widget(
            FileInput::className(),[
                'options'=>[
                    'multiple' => false,
                    'value'=>$model->photoUrl,
                ],
                'pluginOptions'=>[
                    'initialPreview'=>Ad::getPicture($model->id),
                    'previewFileType' => 'any',
                    'showUpload'=>false,
                    'browseLabel'=>'浏览文件',
                    'removeLabel'=>'移除文件',
                    'initialCaption'=>"请选择上传文件",
                    'overwriteInitial'=>true,
                ],

            ])->label("广告图片")?>
        </div>


    <?= $form->field($model, 'mapLink')->textArea(['maxlength' => 200]) ?>

    <?= $form->field($model, 'mapOrder')->textInput() ?>

    <?= $form->field($model, 'adName')->textInput(['maxlength' => 200]) ?>

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
    <!--默认值选中-->
    <?php $dictionaryModel->categoryName=$model->mapLocation;?>

    <?= $form->field($dictionaryModel, 'categoryName')->dropDownList(ArrayHelper::map($dictionaryList,'id','categoryName'),['prompt' => '--请选择对应位置--'])
    ?>
    <?= $form->field($model, 'isValid')->checkbox() ?>
   

<div class="col-lg-7">
    <div class="form-group pull-right">

    <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['id'=>$model->isNewRecord ? 'btnSave' : 'btnUpdate','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
   
    </div>
</div>
    <?php ActiveForm::end(); ?>

 </div>
</div>

</div>

<script type="text/javascript">
  $(function(){

    $("#btnSave").click(function(){
      if(!$("div").hasClass("required has-error")){
         document.getElementById("advertisementForm").submit();
      }
      else{
        return false;
      }
    });

    $("#btnUpdate").click(function(){
      if(!$("div").hasClass("required has-error")){
         document.getElementById("advertisementForm").submit();
      }
      else{
        return false;
      }
    });
   

    $("input[name='Ad[adType]']").click(function(){
        <!-- 1  手机端   2 web端-->
       if ($("input[name='Ad[adType]']:checked").val()=="1") 
        {
          $("#phoneDiv").show();
          $("#webDiv").hide();
        }
        else{
          $("#webDiv").show();
          $("#phoneDiv").hide();
        }
    });

       //开始日期变动 若结束日期小于开始日期  则给结束日期赋值:开始日期
       $("#ad-startdate").change(function(){
            var applyTimeStartValue=$("#ad-startdate").val();
            var applyTimeEndValue=$("#ad-enddate").val();
            var days = DateDiff(applyTimeEndValue,applyTimeStartValue); 
            if (days<0) {
              $("#ad-enddate").val(applyTimeStartValue);
            };
         });
       //结束日期变动 若结束日期小于开始日期  则给开始日期赋值:结束日期
       $("#ad-enddate").change(function(){
            var applyTimeStartValue=$("#ad-startdate").val();
            var applyTimeEndValue=$("#ad-enddate").val();
            var days = DateDiff(applyTimeEndValue,applyTimeStartValue); 
            if (days<0) {
              $("#ad-startdate").val(applyTimeEndValue);
            };
        });

    });

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

