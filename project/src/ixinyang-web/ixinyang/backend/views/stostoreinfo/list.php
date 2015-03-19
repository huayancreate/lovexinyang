<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\ComCategoryMaintain;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

   <!--  <p>
        <?= Html::a('新增店铺信息', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
<?php \yii\widgets\Pjax::begin(['id'=>'stostoreinfoList']); ?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'storeName',
        'storeAddress',
        [
            'attribute' => 'auditState',
            'label'=>'店铺类别',
            'value'=>
                function($model){
                    $categoryModel=ComCategoryMaintain::findOne($model->storeType);
                    if (!empty($categoryModel)) {
                        return $categoryModel->categoryName;
                    }
                    else{
                        return '';
                    }
                    
            },
        ],
        'contactWay',
        'businessHours',
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}',
            'buttons'=>[
                'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "javascript:void(0)",
                    [
                        'title' => Yii::t('yii', '修改'),
                        'onClick'=>'getEdit("'.$model->id.'")'
                    ]);
                },
            ],
        ],
    ],
]); ?>
<?php \yii\widgets\Pjax::end(); ?>

<script type="text/javascript">
<?php $this->beginBlock('JS_END_list'); ?>

function getEdit(id){
    //加载店铺申请信息
    getUpdateInfo(id);
    $("#dialogId").dialog("open");
    $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true,
                    title:"店铺修改",
                    show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                    hide: "explode",       //hide:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                    resizable: true,
                    overlay: {
                        opacity: 0.5,
                        background: "black",
                        overflow: 'auto'
                    },
                buttons: {
                 
                },
                close: function () {
                    $("#dialogId").dialog("close");
                },  
    });
}

//弹出dialog 添加对话框
function getUpdateInfo(id){
     $.ajax({
         type:"post",
         url:"index.php?r=stostoreinfo/update&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

<?php $this->endBlock(); ?>
</script>

<?php 
$this->registerJs($this->blocks['JS_END_list'], \yii\web\View::POS_END);
?>