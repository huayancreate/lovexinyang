<?php
/**
 * Created by PhpStorm.
 * User: olebar
 * Date: 2014/10/22
 * Time: 16:31:54
 */
use backend\assets\TreeAsset;
use yii\helpers\Url;

TreeAsset::register($this);


$this->params['breadcrumbs'] = [
    '菜单管理'
];

?>
    <div class="tree">
        <ul>
            <li>
                <span><i class="icon-leaf"></i>爱信阳菜单管理</span> <a href=""></a>
                <a class="icon-plus" href="<?= Url::to(['sys/menumange','id'=>0,'pid'=>0,'level'=>0]) ?>" title="添加">添加</a>
            </li>
            <li>
                <ul>
                    <?php \yii\widgets\Pjax::begin([]) ?>
                    <!--一级菜单-->
                    <?php
                        function procHtml($array){
                            $html='';
                            if(count($array)>0 && $array!=null){
                                foreach ($array as $val) {
                                    if($val['parentid'] == '0')
                                    {
                                        $html .= "<li><span><i class='icon-leaf'>{$val['menuname']}</i></span></li>";
                                    }
                                    else
                                    {

                                        $html .= "
                                        <li>
                                            <span>
                                                <i class='icon-leaf'></i>"
                                                    .$val['menuname'].
                                            "</span>
                                            <a href=''></a>
                                            <a class='icon-plus' href='".Url::toRoute(['sys/menumange','id'=>'','pid'=>$val['id'],'level'=>$val['level']])."'>添加</a>
                                            
                                            <a class='icon-edit' href='".Url::toRoute(['sys/menumange','id'=>$val['id']])."'>编辑</a>

                                            <a class='icon-trash' href='".Url::toRoute(['sys/menudel','id'=>$val['id'],'level'=>$val['level']])."' data-method='post'  data-confirm='确定要删除当前菜单以及所有子菜单吗?'>删除</a>
                                            ";

                                        if(is_array($val['parentid'])){
                                            $html .= procHtml($val['parentid']);
                                        }
                                        $html = $html."</li>";
                                       
                                    }
                                }
                            }
                            return $html ? '<ul>'.$html.'</ul>' : $html ;
                        }
                        
                        echo procHtml($list);
                    ?>
                </ul>
                <?php \yii\widgets\Pjax::end() ?>
            </li>
        </ul>
    </div>
<script>
    <?php $this->beginBlock('aa') ?>
        $('.tree li:has(ul)').addClass('parent_li').find(' > span');
        //默认收起
        //    $('.tree li.parent_li >span').parent('li.parent_li').find(' > ul > li').hide();
        $('.tree li.parent_li > span').on('click', function (e) {
            var children = $(this).parent('li.parent_li').find(' > ul > li');
            if (children.is(':visible')) {
                children.hide('fast');
                $(this).find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
            } else {
                children.show('fast');
                $(this).find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
            }
            e.stopPropagation();
        });
    <?php $this->endBlock(); ?>
</script>
<?php $this->registerJs($this->blocks['aa']) ?>