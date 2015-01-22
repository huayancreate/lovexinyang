<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComMessageBoxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员消息推送';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-message-box-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加推送', "javascript:void(0)", ['id' => 'addPush', 'class' => 'btn btn-success']) ?>
    </p>

    <?php \yii\widgets\Pjax::begin(['id' => 'pushMessageList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'seeDate',
            'recipientsName',
            'title',
            'summary',
            'content',
            //'readState',
            'sendOutDate',
            //'recipientsId',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php
Dialog::begin([
    'id' => 'div_dialog',
    'clientOptions' => [
        'modal' => true,
        'autoOpen' => false,
        'width' => '965',
        'height' => '485',
    ],
]);
Dialog::end();
?>
<script>
    $("#addPush").click(function () {
        var pageUrl = "com-message-box/pushmessage";
        var submitUrl = "com-message-box/send";
        JuiDialog.showDialog("div_dialog", '添加推送', pageUrl, submitUrl, "messageFrom", "pushMessageList");
    });
</script>