<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-18
 * Time: 22:31
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\DetailView;

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Com Refund Reviews', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<?= DetailView::widget([
    'model' => $order,
    'attributes' => [
        'id',
        'orderNo',
        'totalPrice',
        'userAccount',
        'userName',
        'payTotalPrice',
        'buyTime',
        'methodsPayment',
        'paymentAccount',
    ],
]) ?>
