<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
        <?= Html::a('添加推送', ['pushmessage'], ['class' => 'btn btn-success']) ?>
    </p>

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

</div>
