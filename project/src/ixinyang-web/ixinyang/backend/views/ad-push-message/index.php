<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ad Push Messages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-push-message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Ad Push Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'area',
            'toAge',
            'fromAge',
            'isValid',
            // 'pushIntroduction',
            // 'pushTime',
            // 'pushDetails',
            // 'pushSex',
            // 'messageTopic',
            // 'membershipGrade',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
