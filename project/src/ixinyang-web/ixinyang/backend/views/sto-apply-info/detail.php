<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ComCityCenter;
use backend\models\ComCounty;
use backend\models\ComBusinessDistrict;

?>
<div class="sto-apply-info-detail">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'phone',
            'email',
            'otherContact',
            'storeName',
            [
                'label'=>'城市',
                'value'=>ComCityCenter::findOne($model->city)->cityCenterName,
            ],

            [
                'label'=>'区域',
                'value'=>ComCounty::findOne($model->regional)->countyName,
            ],
            [
                'label' => '商圈',
                'value' => ComBusinessDistrict::findOne($model->businessZone)->businessDistrictName,
            ],
            'address',
            'storePhone',
            'daySales',
            [
                 'label'=>'商家类型',
                 'value'=> !empty($category) ? $category->categoryName : '',
            ],
            'scopeBusiness',
           
        ],
    ]) ?>
            <div class="col-lg-offset-8">
                <div class="form-group">
                    <?= Html::button('审核通过', ['class' => 'btn btn-success','id'=>'btnCheckPass','onclick'=>"checkPassOrFail(1,".$model->applyId.")"]) ?>
                    <?= Html::button('审核驳回', ['class' => 'btn btn-primary','id'=>'btnCheckFail','onclick'=>"checkPassOrFail(2,".$model->applyId.")"]) ?>
                </div>
            </div>
</div>

<script>

    function checkPassOrFail(applyStatus,applyId){
         if(confirm("确定操作吗？")){
                $.ajax({
                    type: "POST",
                    data: {'applyStatus': applyStatus,'applyId':applyId},
                    url: "index.php?r=sto-apply-info%2Fupdate",
                    dataType: "json",
                    success: function (data) {
                        if(data==1){
                            //当成功后操作。。
                            alert("操作成功.");
                            $.pjax.reload({container:'#stoapplyinfoGrid'});
                        }else{
                            alert("操作失败，请重试.");
                        }
                    }
                });
        }
    }


</script>
