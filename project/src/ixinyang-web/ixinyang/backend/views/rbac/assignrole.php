<?php
/**
 *      ┏┓　　　┏┓
 *    ┏┛┻━━━┛┻┓
 *    ┃　　　　　　　┃
 *    ┃　　　━　　　┃
 *    ┃　┳┛　┗┳　┃
 *    ┃　　　　　　　┃
 *    ┃　　　┻　　　┃
 *    ┃　　　　　　　┃
 *    ┗━┓　　　┏━┛
 *        ┃　　　┃   神兽保佑
 *        ┃　　　┃   代码无BUG！
 *         ┃　　　┗━━━┓
 *        ┃　　　　　　　┣┓
 *        ┃　　　　　　　┏┛
 *        ┗┓┓┏━┳┓┏┛
 *          ┃┫┫　┃┫┫
 *          ┗┻┛　┗┻┛
 */
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'] = [
    [
        'label' => '用户管理',
        'url' => '/user/index'
    ],
    '角色授予'
];
?>
<div class="col-lg-12">
    <?= \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
        ],
    ]) ?>
</div>

<div class="col-lg-12">
    <div class="col-lg-5">
        <b>备选角色:</b>
        <?php
        echo Html::listBox('roles', '', $roles, [
            'id' => 'avaliable',
            'multiple' => true,
            'size' => 20,
            'style' => 'width:100%']);
        ?>
    </div>
    <div class="col-lg-1" style="line-height:100px">

        <?=Html::a('>>', '#', ['class' => 'btn btn-success', 'data-action' => 'assign','data-dd'=>'xxxx'])?>
        <br/>
        <?=Html::a('<<', '#', ['class' => 'btn btn-success', 'data-action' => 'delete'])?>
    </div>
    <div class="col-lg-5">
        <b>已有角色:</b>
        <?php
        echo Html::listBox('roles', '', $assignedroles, [
            'id' => 'assigned',
            'multiple' => true,
            'size' => 20,
            'style' => 'width:100%']);
        ?>
    </div>
</div>
<script>
    <?php $this->beginBlock('JS_END') ?>
    yii.process = (function ($)
    {
        var pub = {
            init:function()
            {

            },
            action: function () {
                var action = $(this).data('action');
                var params = $((action == 'assign' ? '#avaliable' : '#assigned')).serialize();
                var urlAssign = '<?= Url::toRoute(['assignrole', 'id' => $id,'action'=>'assign']) ?>';
                var urlDelete = '<?= Url::toRoute(['assignrole', 'id' => $id,'action'=>'delete']) ?>';
                $.post(action=='assign'?urlAssign : urlDelete,
                    params,function (r) {
                        $('#avaliable').html(r[0]);
                        $('#assigned').html(r[1]);
                    },'json');
                return false;
            }
        }
        return pub;
    })(jQuery);
    <?php $this->endBlock() ?>

    <?php $this->beginBlock('JS_READY') ?>
    $('a[data-action]').click(yii.process.action);
    <?php $this->endBlock(); ?>

</script>
<?php
\yii\web\YiiAsset::register($this);
$this->registerJs($this->blocks['JS_END'],\yii\web\View::POS_END);
$this->registerJs($this->blocks['JS_READY']);
?>