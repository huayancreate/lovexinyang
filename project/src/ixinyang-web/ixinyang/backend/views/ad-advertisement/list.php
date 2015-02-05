<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use common\models\ComDictionary;

?>
 <p>
        <?= Html::button( '添加', ['class' => 'btn btn-success','id'=>'btnAdd','onclick'=>"addAd()"]) ?>
    </p>
<?php \yii\widgets\Pjax::begin(['id'=>'adListGrid']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'adType',
                'value'=>function($data){
                  
                  return $data['adType']==1 ? "手机端": "web端";
                }
            ],
            [
                 'attribute'=>'photoUrl',
                'format'=>'html',
                'value'=>function($data){
                    return "<img src=".$data['photoUrl']." width='50px'; />";
                }
            ],
            [
                'attribute'=>'mapLocation',
                'label'=>'广告位置',
                'format'=>'html',
                'value'=>function($model){
                    $comdicModel=ComDictionary::selectCodeNameById($model['mapLocation']);
                    return !empty($comdicModel)? $comdicModel->codeName : "";
                }
            ],
            'mapLink',
            'mapOrder',
             [
                'attribute'=>'isValid',
                'label'=>'是否有效',
                'value'=>function($data){
                  
                  return $data['isValid']==1 ? "有效": "无效";
                }
            ],

             ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
                'buttons'=>[

                        'view'=>function($url,$model){
                              return Html::a('<span class="glyphicon glyphicon-eye-open"></span>','javascript:void(0)',['onclick'=>"viewAdvertise(".$model['id'].")"]);
                         },

                        'update'=>function($url,$model){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>','javascript:void(0)',['onclick'=>"updateAdvertise(".$model['id'].")"]);
                         },

                        'delete'=>function($url,$model){
                        	 if ($model['isValid']=='1') {
                               return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                              Yii::$app->urlManager->createUrl(['ad-advertisement/delete','id' => $model['id']]),
                                [
                                 'title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                 'data' => [
                                      'confirm' => '确定要将该广告置为无效吗?',
                                      'method' => 'post',
                                    ]
                                ]
                                );
                           }
                        },

                 ]
           ],
        ],
    ]); ?>

 <?php \yii\widgets\Pjax::end(); ?>

<script type="text/javascript"> 
<?php
  $this->beginBlock('JSAd_END');
?>
 //弹出dialog 修改对话框
function getUpdateInfo(id){
    $.ajax({
         type:"get",
         url:"index.php?r=ad-advertisement%2Fupdate&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

function updateAdvertise(id){
    getUpdateInfo(id);
     $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 820,
                    height:620,
                    title:"广告修改",
                    show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
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

 //弹出dialog 查看对话框
function getViewInfo(id){
    $.ajax({
         type:"get",
         url:"index.php?r=ad-advertisement%2Fview&id="+id,
         success:function(data) {
            $("#dialogId").html(data);
         }
       });
}

function viewAdvertise(id){
    getViewInfo(id);
     $("#dialogId").dialog("open");
            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    width: 620,
                    height:620,
                    title:"广告查看",
                    show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                    resizable: true,
                    overlay: {
                        opacity: 0.5,
                        background: "black",
                        overflow: 'auto'
                    },
                buttons: {
                     "关闭": function () {
                    $("#dialogId").empty();
                    $(this).dialog('close');
                }    
                },
                close: function () {
                    $("#dialogId").dialog("close");
                },  
              });
}

<?php
  $this->endBlock();
?>
</script>

<?php 
$this->registerJs($this->blocks['JSAd_END'], \yii\web\View::POS_END);
?>