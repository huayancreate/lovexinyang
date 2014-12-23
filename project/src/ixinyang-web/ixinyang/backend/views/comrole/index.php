<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

$this->title = '角色管理';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- <div>
	<?= Html::Button('角色新增',['class'=>'btn btn-primary',
	'style'=>'margin:0px 0px 10px 0px;','id'=>'btnAdd']) ?>
</div> -->
<p> 
    <?= Html::a('角色新增','javascript:void(0)', ['id'=>'btnAdd','class' => 'btn btn-success']) ?> 
</p> 

<div>
	<?php \yii\widgets\Pjax::begin(['id'=>'gridList']); ?>
	<?=GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            "roleName",
            "roleCode",
            [
                'attribute' => 'isValid',
                'label'=>'是否有效',
                'format'=>'html',
                'value'=>
                    function($model){
                        return $model->isValid==1?"有效":"无效";
                    },
            ],
            "creater",
            [
                'class'=>'yii\grid\ActionColumn',
                'header'=>'操作',
                'template' => '{edit} {delete}',
                'buttons'=>[
                    'edit' => function ($url, $model, $key) {
                        return Html::a('权限设置','javascript:void(0)', ['title' => '权限设置','onclick'=>'getRoleEdit('.$model->id.');'] ); 
                    },
                    // 'delete'=>function($url,$model,$key){
                    //     return Html::a('删除','index.php?r=comrole/delete&id='.$model->id,['title' => '删除'] ); 
                    // },
                ],
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>

<div id="divDialog">
    <?php 
        Dialog::begin([
                'id'=>'div_dialog',
                'clientOptions' => [
                'modal' => true,
                'autoOpen' => false,
                'width'=>'600',
                'height'=>'450',
            ],
        ]);
        Dialog::end();
    ?>
</div>

<script type="text/javascript">
<?php $this->beginBlock('JS_END') ?>
	$(function(){
		//新增角色
		$("#btnAdd").click(function(){
            var url="comrole/create";
            JuiDialog.dialog("div_dialog",'新增角色',url,"roleForm","gridList");   
		});
	});

	function getRoleEdit(id){
        var url="comrole/update&id="+id;
        JuiDialog.dialog("div_dialog",'修改',url,"roleForm","gridList");   
	}

<?php $this->endBlock() ?>
</script>  
<?php

\yii\web\YiiAsset::register($this);
    $this->registerJs($this->blocks['JS_END'],\yii\web\View::POS_END);
?>   