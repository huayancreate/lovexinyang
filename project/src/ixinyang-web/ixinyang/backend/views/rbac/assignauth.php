<?php
/**
 * Created by PhpStorm.
 * User: olebar
 * Date: 2014/10/27
 * Time: 15:37:32
 */

use yii\widgets\DetailView;
$auth = Yii::$app->authManager;
$user = Yii::$app->user;

$this->params['breadcrumbs'] = [
    [
        'label'=>'角色管理',
        'url'=>'/rbac/roles',
    ],
    '角色授权'
];
?>

<?= DetailView::widget([
    'model'=>$model,
    'attributes'=>[
        'name',
        'description'
    ]
]) ?>

<div class="table-responsive">
    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th class="hidden-320">模块</th>
            <th>菜单</th>
        </tr>
        </thead>
        <tbody>
        <?php if( $list != null):?>
            <?php foreach ($list as $k): ?>
                <tr>
                    <td style='width:15%'>
                        <input type="checkbox" 
                            <?php if ($auth->hasChild($role,$auth->getPermission($k['route']))): ?>
                                checked 
                            <?php endif; ?>
                            onclick="ckbox(1,this)" name="<?= $k['id'] ?>" id="<?= $k['id'] ?>"/>

                        <?=$k['menuname']?>
                    </td>
                    <td>
                    <?php if (is_array($k['parentid'])): ?>
                        <?php foreach ($k['parentid'] as $p) :?>
                            <input type="checkbox"
                                name="<?= $k['id'] . '_' . $p['id'] ?>"
                                id="<?= $p['id'] ?>"
                                <?php if ($auth->hasChild($role,$auth->getPermission($p['route']))): ?>
                                    checked
                                <?php endif; ?>
                                    onclick="ckbox(2,this)"/>

                            <?= $p['menuname'] ?>&nbsp;
                        <?php endforeach;?>
                    <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    function ckbox(level, o) {
        var name = $(o).attr('name');
        var id = $(o).attr('id');
        var val = $(o).val();
        var thischecked = $(o).is(':checked');
        //选中所有子孙
        $('input[name*=' + name + '_]').prop('checked', thischecked);
        //取消选中时判断父节点
        var arr = name.split('_');
        if (level == 3) {
            //如果3级菜单全都没选中，对应的2级菜单也取消选中
            var cntlv3 = $('input[name*=' + arr[0] + '_' + arr[1] + '_]:checked').size();
            if (cntlv3 > 0) {
                $('input[name=' + arr[0] + '_' + arr[1] + ']').prop('checked', true);
            } else {
                $('input[name=' + arr[0] + '_' + arr[1] + ']').prop('checked', false);
            }
        }
        if (level >= 2) {
            //如果2级菜单都没选中 1级菜单也取消选中
            var cntlv2 = $('input[name*=' + arr[0] + '_' + ']:checked').size();
            if (cntlv2 > 0) {
                $('#' + arr[0]).prop('checked', true);
            } else {
                $('#' + arr[0]).prop('checked', false);
            }
        }
        //更新数据
        var data = 'menuid=' + id + '&ck=' + thischecked + '&rolename=' + '<?= $rolename ?>';

        $.post('<?= \yii\helpers\Url::toRoute(["rbac/assignauth"]) ?>',data);
        //$.post('/rbac/assignauth',data);
    }
</script>