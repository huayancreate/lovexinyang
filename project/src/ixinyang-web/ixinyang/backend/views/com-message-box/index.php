<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComMessageBoxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '会员消息推送';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-message-box-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加推送', ['pushmessage'], ['class' => 'btn btn-success']) ?>
    </p>

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

</div>