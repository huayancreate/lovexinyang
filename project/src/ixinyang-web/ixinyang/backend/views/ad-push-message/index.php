<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdPushMessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App 广告推送';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-push-message-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('添加推送', "javascript:void(0)", ['id' => 'addPush', 'class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(['id' => 'pushMessageList']); ?>
    <?= GridView::widget([
        'id'=>'pushMessageGrid',
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'area',
            //'toAge',
            //'fromAge',
            //'isValid',
            'messageTopic',
            'pushIntroduction',
            'pushDetails',
            'pushTime',
            //'pushSex',
            //'membershipGrade',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php
Dialog::begin([
    'id' => 'dialogId',
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'width' => '965',
        'height' => '580',
    ],
]);
Dialog::end();
?>
<script type="text/javascript">
    $("#addPush").click(function () {
       /* var pageUrl = "ad-push-message/pushmessage";
        var submitUrl = "ad-push-message/send";
        JuiDialog.showDialog("div_dialog", '添加推送', pageUrl, submitUrl, "messageFrom", "pushMessageList");*/
        //弹出dialog 添加对话框
        
      getLoadInfo();
      $("#dialogId").dialog("open");

            $("#dialogId").dialog({
                    autoOpen:false,
                    modal: true, 
                    title:"消息推送添加",
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


    });

    //弹出dialog 添加对话框
    function getLoadInfo(){
         $.ajax({
             type:"post",
             url:"index.php?r=ad-push-message/pushmessage",
             success:function(data) {
                $("#dialogId").html(data);
             }
           });
    }
</script>

