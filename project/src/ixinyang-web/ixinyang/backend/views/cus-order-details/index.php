<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\CusOrderDetails;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CusOrderDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cus Order Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-order-details-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'id'=>'gridList',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            'validateCode',
            'goodsName',
            'price',
            'rebate',
            'rebatePrice',
            [
                'attribute' => 'CodeStatus',
                'label'=>'状态',
                'format'=>'html',
                'value'=>
                    function($model){
                       return CusOrderDetails::getCodeStatus($model->CodeStatus);
                    },
            ],
            //['class'=>'yii\grid\ActionColumn',]
        ],
    ]); ?>
</div>

<?php
    $this->registerJs(
        '$(function(){
            $("#btnSave").click(function(){
                var keys = $("#gridList").yiiGridView("getSelectedRows");
                if(keys==""){
                    alert("请选择消费项！");
                    return;
                }
                if(confirm("是否确认消费！")){
                    var url="cus-order-details/consumption";
                    $.ajax({
                        cache: true,
                        type: "POST",
                        url:"index.php?r="+url,
                        data:{keys:keys},
                        success: function (data) {
                           alert(data);
                        }
                    });
                }
            });
           
        });'
    )
?>