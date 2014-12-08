<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Shop Info Reviews';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-info-review-index">
    <p>
        <?= Html::a('分店申请','javascript:void(0);', ['id'=>'btnAdd','class' => 'btn btn-success']) ?>
    </p>
<?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'city',
            //'longitude',
            //'latitude',
            'shopName',
            'contact',
            // 'regional',
            // 'storeId',
            // 'storeAccount',
            // 'businessDistrictId',
            'address',
            'businessHours',
            // 'storeOutline:ntext',
            // 'cityId',
            // 'countyId',
            // 'applyTime',
            // 'applyUserId',
            // 'applyUserName',
            // 'auditUserId',
            // 'auditUserName',
            // 'auditTime:datetime',
            // 'managerId',
            // 'managerName',
            // 'managerTime:datetime',
            [
                'attribute' => 'auditState',
                'label'=>'状态',
                'value'=>
                    function($model){
                        return $model->getState($model->auditState);
                    },
            ],
            // 'Rejection',

            ['class' => 'yii\grid\ActionColumn',
                'buttons'=>[
                    'view'=>function($url,$model){
                        return Html::a('<span class="glyphicon  glyphicon-eye-open"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                                'onClick'=>'View("类别查看","index.php?r=com-category-maintain/view&id=",'.$model->id.')'
                            ]);
                    },
                    'update'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "javascript:void(0)",
                        [
                            'title' => Yii::t('yii', '修改'),
                            'data-pjax' => '0',
                            'onClick'=>'View("类别修改","index.php?r=com-category-maintain/update&id=",'.$model->id.')'
                        ]);
                    },
                    'delete'=>function($url,$model){
                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', "javascript:void(0)",
                        [
                            'title' => Yii::t('yii', '删除'),
                            'data-pjax' => '0',
                            'onClick'=>'Delete('.$model->id.')'
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
<?php \yii\widgets\Pjax::end(); ?>
</div>
 <?php 
      Dialog::begin([
      'id'=>'dialogId',
      'clientOptions' => [
            'modal' => true,
            'autoOpen' => false,
            'width'=>'500',
            'height'=>'550',
            'resizable'=> true,
      ],]);
  ?>    

<?php
    Dialog::end();
?>

<script type="text/javascript"> 

<?php $this->beginBlock('JS_END'); ?>

$(function(){
    $("#btnAdd").click(function(){
        getView("shopinforeview/create");
        $("#dialogId").dialog({
            title:"分店申请",
            buttons: {
                '保存': function () {
                    postAction("shopinforeview/create");
                    $(this).dialog('close');
                },
                "取消": function () {
                    $(this).dialog('close');
                }             
            },
            close: function () {
                $("#dialogId").dialog("close");
            },  
        });

        $("#dialogId").dialog("open");
    });
});

function getView(url){
    $.ajax({
        type:"get",
        url:"index.php?r="+url,
        success:function(data) {
            $("#dialogId").html(data);
        }
    });
}

function postAction(url){
    $.ajax({
        cache: true,
        type: "POST",
        url:"index.php?r="+url ,
        data: $('#shopinforeviewFrom').serialize(),
        async: false,
        error: function (request) {
            alert("Connection error");
        },
        success: function (data) {
            $.pjax.reload({container:'#w2'});
        }
    });
}

<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>