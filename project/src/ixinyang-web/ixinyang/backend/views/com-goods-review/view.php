<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ComGoodsReview */

$this->title = $model->cgrId;
$this->params['breadcrumbs'][] = ['label' => 'Com Goods Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-goods-review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->cgrId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->cgrId], [
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
            'cgrId',
            'goodsId',
            'goodsName',
            'applyerId',
            'applyerAccount',
            'applyTime',
            'reviewerId',
            'reviewerName',
            'reviewTaskId',
            'reviewTime',
            'reviewStatus',
            'remark',
        ],
    ]) ?>

</div>
