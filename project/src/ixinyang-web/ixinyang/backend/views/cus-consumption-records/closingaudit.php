
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '截至到结算日期的消费明细';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="cus-consumption-records-closingaudit">

    <h1><?= Html::encode($this->title) ?></h1>
    <label>总计：(￥) <?php echo $consumpRecModel->payablePrice;?></label>
    <?php Pjax::begin(['id' => 'countries',]) ?>
    <?= GridView::widget([
        'id'=>'closingauditGrid',
        'options' => ['data-pjax' => true ],
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'verifierTime',
            'userAccount',
            'goodsNumber',
            'payablePrice',
            'verifierAccount',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function () {
                        return null;
                    },
                    'update' => function () {
                        return null;
                    },
                    'delete' => function () {
                        return null;
                    }
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end() ?>

     <?php 
            $form = ActiveForm::begin([
                'layout'=> 'horizontal',
                    'id'=>'closingauditForm',
                ]); 
     ?>
            <div class="col-lg-offset-8">
                <div class="form-group">
                <?= Html::button('审核通过', ['class' => 'btn btn-success','id'=>'btnCheckPass','onclick'=>'checkPass(1,"'.$balanceReviewModel->id.'","'.$balanceReviewModel->balanceStartTime.'","'.$balanceReviewModel->balanceEndTime.'","'.$balanceReviewModel->shopId.'")']) ?>
                    <?= Html::button('审核驳回', ['class' => 'btn btn-primary','id'=>'btnCheckFail','onclick'=>"checkFail()"]) ?>
                </div>
            </div>
            
        <!-- 驳回备注  点击驳回按钮出现-->
        <div class="row" id="remarkDiv" style="display:none" >
          <div class="panel panel-default">
              <div class="panel-heading">审核驳回备注</div>
              <div class="panel-body">
                <div class="col-lg-12">
                    <div class="col-xs-7">
                     <?= $form->field($balanceReviewModel, 'remark')->textArea() ?>
                    </div>
                
                  <?= Html::button('确定', ['class' => 'btn btn-success','id'=>'btnSave','onclick'=>"saveRejectRemark(2,".$balanceReviewModel->id.")"]) ?>
                </div>
              </div>
          </div>
        </div>
      <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript"> 


    //审核通过
    function checkPass(financeReviewStatus,id,balanceStartTime,balanceEndTime,shopId){
        if(confirm("确定审核通过吗？"))
        {
           $.ajax({
            type: "POST",
            data: {'financeReviewStatus': financeReviewStatus,'id':id,'balanceStartTime':balanceStartTime,'balanceEndTime':balanceEndTime,'shopId':shopId},
            url: "index.php?r=cus-consumption-records%2Fcheckpass",
            dataType: "json",
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                if(data.success){
                    //当成功后操作。。
               
                alert("操作成功");
                $.pjax.reload({container:'#balancereviewGrid'});

                }else{
                    alert("操作失败原因："+data.errormsg+",请重试.");
                }
            }
          });
        }
        else{

        }
        
       
    }

    //审核驳回   审核通过和审核驳回按钮都不可用
    function checkFail(){
        if(confirm("确定审核驳回吗？"))
        {
            $("#remarkDiv").show();
            $("#btnCheckPass").attr("disabled",true);
            $("#btnCheckFail").attr("disabled",true);
        }
        else{

        }
       
    }
  
    //保存驳回备注
    function saveRejectRemark(financeReviewStatus,id)
    {
        if(confirm("确定审核驳回吗？"))
        {
            //驳回备注
            var remark=$("#stobalancereview-remark").val();

             $.ajax({
                type: "POST",
                data: {'remark':remark,'financeReviewStatus': financeReviewStatus,'id':id},
                url: "index.php?r=cus-consumption-records%2Fcheckfail",
                dataType: "json",
                error: function (request) {
                    alert("Connection error");
                },
                success: function (data) {
                    if(data==1){
                        //当成功后操作。。
                        alert("操作成功.");
                        $.pjax.reload({container:'#balancereviewGrid'});
                    }else{
                        alert("操作失败，请重试.");
                    }
                }
            });
          }
        else{

        }
       
    }



 /*  $("document").ready(function(){ 
        $("ul li a").on("click", function() {
            $.pjax.reload({container:"#closingauditGrid"});  //Reload GridView
        });
    });*/



</script>

