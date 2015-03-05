<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;
use yii\helpers\Url;
use backend\assets\TreeAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComCategoryMaintainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

TreeAsset::register($this);

$this->title = '类别维护';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-category-maintain-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--   <p>
    <a class="btn btn-success" href="#"
       onclick="View('创建类别','index.php?r=com-category-maintain/create','')">创建类别</a>

</p> -->

   <div class="tree">
    <ul>
        <li>
            <ul>
                <?php \yii\widgets\Pjax::begin(['id' => 'categoryList']) ?>
                <!--一级菜单-->
                 <?php

                    function procHtml($array) {
                        $html = '';
                        if (count($array) > 0 && $array != null) {
                            foreach ($array as $val) {
                                if ($val['parentCategoryId'] == '0') {
                                    $html .= "<li><span><i class='icon-leaf'>{$val['categoryName']}</i></span></li>";
                                } else {

                                    $html .= "
                                            <li>
                                                <span>
                                                    <i class='icon-leaf'></i>"
                                            . $val['categoryName'] .'【'.  ($val['categoryType']==1 ? '商品类别' :  '评价类别' ).'【'.($val['isValid'] == 1 ? "有效" : "无效").
                                            "</span>
                                            <a onclick=View('创建类别','index.php?r=com-category-maintain/create','')>添加</a>
                                            <a onclick=View('类别修改','index.php?r=com-category-maintain/update&id=','".$val['id']."')>编辑</a>";

                                    if (is_array($val['parentCategoryId'])) {
                                        $html .= procHtml($val['parentCategoryId']);
                                    }
                                    $html = $html . "</li>";
                                }
                            }
                        }
                        return $html ? '<ul>' . $html . '</ul>' : $html;
                    }

                    echo procHtml($list);
                 ?>
            </ul>
             <?php \yii\widgets\Pjax::end() ?>
        </li>
    </ul>
   </div>

</div>
<div id="treeGrid"></div>
<?php
Dialog::begin([
    'id' => 'viewDialog',
    'clientOptions' => ['modal' => true, 'autoOpen' => false, 'width' => '800', 'height' => '500'],]);
?>
<div id="view"></div>
<?php
Dialog::end();
?>
<script type="text/javascript">
    <?php
       $this->beginBlock('JS_END');
   ?>
    function View(title, url, id) {
        $("#viewDialog").dialog("open");
        $("#viewDialog").dialog({
            width: 800,
            height: 500,
            title: title,
            resizable: true,
            overlay: {
                opacity: 0.5,
                background: "black",
                overflow: 'auto'
            },
            close: function () {
                //$.pjax.reload({container:'#w0'});
            },
            buttons: [
                {
                    text: "保存",
                    "class": 'btn btn-success',
                    click: function () {
                        if ($("form").valid(this, "error!") == true) {
                            SaveOrUpdate(url, id);
                            $(this).dialog('close');
                        }
                    }
                },
                {
                    text: "取消",
                    "class": 'btn btn-danger',
                    click: function () {
                        $(this).dialog('close');
                    }
                }
            ]
        });

        if (id != 0) {
            url = url + id;
        }
        $.post(url, function (result) {
            $("#viewDialog").html(result);
        });
    }
    function SaveOrUpdate(url, id) {
        $.ajax({
            cache: true,
            type: "POST",
            url: url,
            data: $('#categoryForm').serialize(),// 你的formid
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                $.pjax.reload({container: '#categoryList'});
            }
        });
    }
    function Detail(title, url) {
        JuiDialog.dialogView("viewDialog", title, url);
    }

    $('.tree li:has(ul)').addClass('parent_li').find(' > span');
    //默认收起
    //    $('.tree li.parent_li >span').parent('li.parent_li').find(' > ul > li').hide();
    $('.tree li.parent_li > span').on('click', function(e) {
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


    <?php
      $this->endBlock('JS_END');
  ?>
</script>
<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/zTreeStyle.css', []);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/bootstrap3-validation.js',[]);
$this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END)
?>
