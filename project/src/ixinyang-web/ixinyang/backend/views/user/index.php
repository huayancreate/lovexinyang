<?php
header("Content-type:text/html;charset=utf-8");

use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use common\hycommon\utils\MyHelper;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\SwitchInput;

$this->params['breadcrumbs'] = [
    '用户管理',
];
?>

<?php
Modal::begin([
    'id' => 'md',
    'header' => '<h4>添加用户</h4>',
    'footer' => '<button type="button" class="btn btn-primary" onclick="sbmt()">确定</button>',
        // 'clientOptions'=>[
        //     'remote'=>'index.php?r=user/loadhtml'
        // ]
]);
Modal::end();
?>

<p>
<!-- <?=
    \yii\helpers\Html::button('添加用户', [
        'class' => 'btn btn-sm btn-success',
        //'onclick' => '$("#md").modal();'
        'onclick' => 'loadhtml("")'
    ])
    ?>   -->

<!--<?= \yii\helpers\Html::a('添加用户',['user/loadhtml'], [
    'class' => 'btn btn-sm btn-success',
]) ?>-->
</p>
<?=
\yii\grid\GridView::widget([
    'dataProvider' => $dataprovider,
    //'filterModel' => $searchmodel,
    'columns' => [
        [
            'attribute'=>'username',
        ],
        [
            'header' => '角色',
            'content' => function ($model) {
                $roles = Yii::$app->authManager->getRolesByUser($model->id);
                $roles = implode(',', array_keys($roles));
                return $roles;
            },
        ],
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function ($model) {
                return  $model->status==10?"启用":"锁定";
            },
        ],
        [
            'header' => '操作',
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {reset} {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<span class="glyphicon glyphicon-user"></span>',
                            'index.php?r=rbac/assignrole&id=' . $key,
                            ArrayHelper::merge([
                                'title' => Yii::t('yii', 'View'),
                                'data-pjax' => '0',
                                    ], ['title' => '角色授权']));
                    },
                'delete' => function ($url, $model, $key) {
                    return MyHelper::actionbutton($url, 'delete');
                },
                'reset'=>function($url,$model, $key){
                    return Html::a('<span class="glyphicon glyphicon-transfer"></span>',
                            'index.php?r=user/changepwd&id=' . $key,
                            ArrayHelper::merge([
                                'title' => Yii::t('yii', 'reset'),
                                'data-confirm' => Yii::t('yii', '是否确定重置密码?'),
                                'data-pjax' => '0',
                            ], ['title' => '密码重置']));
                }
            ]
        ],
    ],
])
?>
<script>
<?php $this->beginBlock('js_end') ?>
    function sbmt() {
        $('#userform').submit();
    }
    function loadhtml(id)
    {
        $('.modal-body').load('index.php?r=user/loadhtml', {id: id}, function() {
            $('#md').modal();
        });
    }
<?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['js_end'], \yii\web\View::POS_END) ?>