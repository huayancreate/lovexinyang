<?php
/**
 *	  ┏┓　　　┏┓
 *	┏┛┻━━━┛┻┓
 *	┃　　　　　　　┃
 *	┃　　　━　　　┃
 *	┃　┳┛　┗┳　┃
 *	┃　　　　　　　┃
 *	┃　　　┻　　　┃
 *	┃　　　　　　　┃
 *	┗━┓　　　┏━┛
 *	    ┃　　　┃   神兽保佑
 *	    ┃　　　┃   代码无BUG！
 *	 	┃　　　┗━━━┓
 *	    ┃　　　　　　　┣┓
 *	    ┃　　　　　　　┏┛
 *	    ┗┓┓┏━┳┓┏┛
 *	      ┃┫┫　┃┫┫
 *	      ┗┻┛　┗┻┛
 */
use yii\grid\GridView;
use yii\helpers\Html;
use common\hycommon\utils\MyHelper;
use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    '角色管理',
];
?>
<p>
    <?= Html::a('添加角色','index.php?r=rbac/managerole&id=',['class'=>'btn btn-sm btn btn-success']) ?>
</p>

<?= GridView::widget([
    'dataProvider'=>$dataprovider,
    'columns'=>[
        [
            'class'=>'yii\grid\SerialColumn',
            'header'=>'编号'
        ],
        'name:text:名称',
        'description:text:描述',
        //'ruleName:text:规则名称',
        'createdAt:datetime:创建时间',
        [
            'class'=>'yii\grid\ActionColumn',
            'header'=>'操作',
            'template'=>'{view} {update} {delete}',
            'buttons'=>[
                'view'=>function($url,$model,$key)
                {
                    return MyHelper::actionbutton(['rbac/assignauth','rolename'=>$key],'view',['title'=>'分配权限']);
                },
                'update'=>function($url, $model, $key)
                {
                    return MyHelper::actionbutton(Url::to('index.php?r=rbac/managerole&id='.$key),'update');
                },
                'delete'=>function($url,$model,$key)
                {
                    return MyHelper::actionbutton('index.php?r=rbac/deleterole&id='.$model->name,'delete');
                }
            ]
        ]
    ],
]) ?>