<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '店铺信息';
$this->params['breadcrumbs'][] = $this->title;

?>

<div id="div_applyInfo"></div>
<?php
    echo yii\bootstrap\Tabs::widget([
      'items' => [
            [
                'label' => '店铺信息查看',
                'content' =>
                    '<div style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                        $this->render('list', ['dataProvider' => $dataProvider,])
                    ."</div>",
            ],
            [
                'label' => '店铺信息申请',
                'content' => 
                    '<div data-pjax="true" style="border:1px solid #ccc;border-top:0px;padding:15px;">'.
                        $this->render('../shop-info-review/index',['dataProvider'=>$shoInforeViewData]).
                    '</div>',
            ],
        ],
    ]);
?>

<script type="text/javascript"> 
<?php $this->beginBlock('JS_END'); ?>
    $(function(){
        JuiDialog.getPage("div_applyInfo","sto-apply-info/view");
    });

<?php $this->endBlock(); ?>
</script>
<?php 
$this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END);
$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/assets/771e789c/kindeditor.js',  ['depends' => [JqueryAsset::className()]]);

?>