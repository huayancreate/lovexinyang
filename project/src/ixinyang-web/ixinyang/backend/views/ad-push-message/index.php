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

    <h1><?= Html::encode($this->title) ?></h1>
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
<script type="text/javascript">
    $("#addPush").click(function () {
        var pageUrl = "ad-push-message/pushmessage";
        var submitUrl = "ad-push-message/send";
        JuiDialog.showDialog("div_dialog", '添加推送', pageUrl, submitUrl, "messageFrom", "pushMessageList");
    });
</script>

