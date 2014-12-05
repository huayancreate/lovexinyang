<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '店铺信息';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php



    echo yii\bootstrap\Tabs::widget([
      'items' => [
            [
                'label' => '店铺信息查看',
                'content' =>
                    '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                        $this->render('list', ['dataProvider' => $dataProvider,])
                    ."</div>",
                'active' => true
            ],
            [
                'label' => '店铺信息申请',
                'content' => 
                    '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                        $this->render('../shopinforeview/index',['dataProvider'=>$shoInforeViewData]).
                    '</div>',
                //'headerOptions' => ['style'=>'width:auto'],
                //'options' => ['id' => 'myveryownID'],
            ],
        ],
    ]);
?>