<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AdPushMessage */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ad Push Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-push-message-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'area',
            'toAge',
            'fromAge',
            'isValid',
            'pushIntroduction',
            'pushTime',
            'pushDetails',
            'pushSex',
            'messageTopic',
            'membershipGrade',
        ],
    ]) ?>

</div>
