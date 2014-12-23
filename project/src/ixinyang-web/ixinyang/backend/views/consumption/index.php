<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cus Consumption Records';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-consumption-records-index">
    <!-- <p>
        <?= Html::a('Create Cus Consumption Records', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'id'=>'actionForm',
        'action'=>['consumption/memberinfo']
    ]); ?>
    
    <?= $form->field($model, 'memberCardNo')->textInput([
        'class'=>'form-control',
        'placeholder'=>"请输入会员卡号",
        'style'=>'align:middle',
        'id'=>'memberCardNo',
    ]) ?>
    <?= Html::SubmitButton('搜索', ['class' => 'btn btn-warning','id'=>'btnSearch']) ?>
 <?php ActiveForm::end(); ?>

<?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'id'=>'memberForm',
]); ?>
    <h4><b>会员信息</b></h4>
    <div style="background-color:lightseagreen;height:3px;margin-bottom:10px;"></div>
        <table style="width:100%">
            <tr>
                <td style="text-align:center;width:50%;padding:5px;">
                    <div style="background:url('<?= $member->ico ?>');width:413px;height:250px;">
                        <div style="FILTER: mask(color=#E1E4EC)shadow(color=#8C96B5,direction=135)
                                chroma(color=#E1E4EC);padding:15px;" align="left">
                            <font face="黑体" color="#8C96B5" size="4">
                                <b><i>北京庆丰包子铺</i></b>
                            </font>
                        </div>
                        <div style="height:135px;">
                            <div style="height:50%;"><?=$model->memberCardNo?></div>
                            <!-- <div style="height:50%;">王八犊子</div> -->
                        </div>
                        <div style="FILTER: mask(color=#E1E4EC)shadow(color=#8C96B5,direction=135)
                                chroma(color=#E1E4EC);padding:20px;" align="right">
                            <font face="黑体" color="#FF5809" size="4">
                                <b><i>华研科技</i></b>
                            </font>
                        </div>
                    </div>
                </td>
                <td style="width:50%;" align="center">
                    <div class="input-group" style="padding:10px;">
                        <b>实收：</b>
                        <?= $form->field($model, 'costPrice')->textInput() ?>
                        <div class="input-group-addon">元</div>
                    </div>
                    <div class="input-group" style="padding:10px;">
                        <b>折扣：</b>
                        <?= $form->field($model, 'rebate')->textInput([
                            'readonly'=>'readonly',
                        ]) ?>
                        <div class="input-group-addon">折</div>
                    </div>
                    <div class="input-group" style="padding:10px;">
                        <b>应收：</b>
                        <?= $form->field($model, 'payablePrice')->textInput([
                            'readonly'=>'readonly',
                        ]) ?>
                        <div class="input-group-addon">元</div>
                    </div>
                    <div style="text-align:center;width:83%;padding-top:15px;">
                    <input type="hidden" name='CusConsumptionRecords[memberCardNo]' value="<?=$model->memberCardNo?>" />
                        <?=
                            Html::button('确认消费',[
                                'id'=>'btnSave',
                                'class'=>'btn btn-warning'
                            ]);
                        ?>
                    <div>   
                </td>
            </tr>
        </table>
 <?php ActiveForm::end(); ?>    

    <h4><b>最近消费记录</b></h4>
    <div style="background-color:lightseagreen;height:3px;margin-bottom:10px;"></div>
    
<?php \yii\widgets\Pjax::begin(['id'=>'gridList']); ?>
   <?= $this->render('list', ['dataProvider' => $dataProvider,]) ?>
<?php \yii\widgets\Pjax::end(); ?>

</div>


<script type="text/javascript"> 

<?php $this->beginBlock('JS_END'); ?>

    $(function(){

        $("#cusconsumptionrecords-costprice").keyup(function(){
            var r=$("#cusconsumptionrecords-rebate").val();
            var m=$(this).val();
            if(r>0){
                m=m*(r/100)*10;
                $("#cusconsumptionrecords-payableprice").val(round(m,2));
            }else{
                $("#cusconsumptionrecords-payableprice").val(m);
            }
        });

        $("#btnSave").click(function(){
            var url="consumption/cashsave";
            $.ajax({
                cache: true,
                type: "POST",
                url:"index.php?r="+url ,
                data: $('#memberForm').serialize(),
                dataType: "json", 
                success: function (data) {
                }
            });
        });
            
    });

    function round(digit, length) {
        length = length ? parseInt(length) : 0;
        if (length <= 0) return Math.round(digit);
            digit = Math.round(digit * Math.pow(10, length)) / Math.pow(10, length);
        return digit;
    };

<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>
