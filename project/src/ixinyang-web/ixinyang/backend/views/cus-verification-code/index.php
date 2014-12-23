<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CusVerificationCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cus Verification Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cus-verification-code-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br/>
    <?php
        $form = ActiveForm::begin([ 'layout' => 'inline','id'=>'goodsFrom',
                    'action'=>['cus-verification-code/consumption'], 'method'=>'POST']);
        echo DetailView::widget([
            'model' => $orderDetailsModel,
            'attributes' => [
               'memberCardNo',
               'goodsName',
               'price',
               'totalNum',
               'totalPrice',
               'rebate',
               'rebatePrice',
            ],
        ]);
     ?>
    <div>
        <?php
            if($orderDetailsModel->id>0){

                $form = ActiveForm::begin([ 'layout' => 'inline','id'=>'goodsFrom',
                    'action'=>['cus-verification-code/consumption'], 'method'=>'POST']);

                    echo $form->field($searchModel,'orderDetailsId')->hiddenInput(['value'=>$orderDetailsModel->id])->label("");

                    echo Html::submitbutton('确认消费',['class'=>'btn btn-success']);

                ActiveForm::end();
            }
        ?>
    </div>
    <br/>
    <h4><b>消费历史记录</b></h4>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'orderNo',
            'memberName',
            'verfificationCode',
            'goodsNumber',
            'costPrice',
            'rebate',
            'payablePrice',
            'shopName',
            'verifierTime',
            'verifierAccount',
        ],
    ]); ?>
    
</div>
