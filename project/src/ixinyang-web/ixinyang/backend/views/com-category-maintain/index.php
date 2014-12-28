<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComCategoryMaintainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '类别维护';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-category-maintain-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <a class="btn btn-success" href="#"
           onclick="View('创建类别','index.php?r=com-category-maintain/create','')">创建类别</a>

    </p>
    <?php \yii\widgets\Pjax::begin(['id' => 'categoryList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'categoryName',
            'categoryCode',
            [
                'attribute' => 'categoryType',
                'label' => '类别类型',
                'value' => function ($model) {
                    return $model['categoryType'] == 1 ? "商品类别" : "评价类别";
                }
            ],
            'sort',
            [
                'attribute' => 'isValid',
                'label' => '状态',
                'value' => function ($model) {
                    return $model['isValid'] == 1 ? "有效" : "无效";
                }
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '80'],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon  glyphicon-eye-open"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '查看'),
                                'data-pjax' => '0',
                                'onClick' => 'View("类别查看","index.php?r=com-category-maintain/view&id=",' . $model->id . ')'
                            ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '修改'),
                                'data-pjax' => '0',
                                'onClick' => 'View("类别修改","index.php?r=com-category-maintain/update&id=",' . $model->id . ')'
                            ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', "javascript:void(0)",
                            [
                                'title' => Yii::t('yii', '删除'),
                                'data-pjax' => '0',
                                'onClick' => 'Delete(' . $model->id . ')'
                            ]);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
<?php
Dialog::begin([
    'id' => 'viewDialog',
    'clientOptions' => ['modal' => true, 'autoOpen' => false],]);
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
    function Delete(id) {
        if (confirm("确定要删除数据吗")) {
            $.ajax({
                cache: true,
                type: "POST",
                url: "index.php?r=com-category-maintain/delete&id=" + id,
                data: $('#categoryForm').serialize(),
                async: false,
                error: function (request) {
                    alert("Connection error");
                },
                success: function (data) {
                    $.pjax.reload({container: '#categoryList'});
                }
            });
        }
    }
    <?php
      $this->endBlock('JS_END');
  ?>
</script>
<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/zTreeStyle.css', []);
$this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END)
?>
