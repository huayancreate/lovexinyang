<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-04
 * Time: 10:24
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use backend\models\ComRole;
use backend\models\ComPersonRolerelation;
use yii\jui\Dialog;
use yii\web\JqueryAsset;


$this->title = '录入新工号';
$this->params['breadcrumbs'][] = '账号管理';
?>

    <div class="com-category-maintain-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <?= Html::a('创建账号', 'javascript:void(0)', ['class' => 'btn btn-success', 'onClick' => 'View("创建账号","index.php?r=com-account/create")']) ?>
            <!--        <a class="btn btn-success" href="#" onclick="View('创建类别','index.php?r=com-category-maintain/create','')">创建类别</a>-->
        </p>

        <div>
            <?php \yii\widgets\Pjax::begin(['id' => 'accountList']); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'userName',
                    'nickname',
                    'sex',
                    'phoneNumber',
                    'email:email',
                    'address',
                    [
                        'attribute' => 'accountStatus',
                        'label' => '状态',
                        'filter' => false,
                        'value' => function ($model) {
                            return $model['accountStatus'] == 1 ? "有效" : "无效";
                        }
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'header' => '操作', 'headerOptions' => ['width' => '100'],
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a('<span class="glyphicon  glyphicon-eye-open"></span>', 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'View'),
                                        'onClick' => 'View("账号查看","index.php?r=com-account/view&id=' . $model['id'] . '")'
                                    ]);
                            },
                            'update' => function ($url, $model) {
                                $person = ComPersonRolerelation::find()->where(['personId' => $model['id']])->one();
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'Update'),
                                        'data-pjax' => true,
                                        'onClick' => 'View("账号修改","index.php?r=com-account/update&id=' . $model['id'] . '&roleId=' . $person->id . '")'
                                    ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-pjax' => true,
                                        'onClick' => 'Delete("index.php?r=com-account/delete&id=' . $model['id'] . '")'
                                    ]);
                            }

                        ]
                    ],
                ],
            ]); ?>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
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
        function View(title, url) {
            $("#viewDialog").html("");
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
                buttons: [
                    {
                        text: "保存",
                        "class": 'btn btn-success',
                        click: function () {
                            SaveOrUpdate(url);
                            $(this).dialog('close');
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
            $("#viewDialog").load(url);
        }

        function SaveOrUpdate(url) {
            $.ajax({
                cache: true,
                type: "POST",
                url: url,
                data: $('#accountForm').serialize(),// 你的formid
                async: false,
                error: function (request) {
                    alert("Connection error");
                },
                success: function (data) {
                    //alert(data);
                    $.pjax.reload({container: '#accountList'});
                }
            });
        }

        function Delete(url) {
            if (confirm("确定要删除数据吗")) {
                $.ajax({
                    cache: true,
                    type: "POST",
                    url: url,
                    data: $('#accountForm').serialize(),
                    async: false,
                    error: function (request) {
                        alert("Connection error");
                    },
                    success: function (data) {
                        $.pjax.reload({container: '#accountList'});
                    }
                });
            }
        }

    </script>

<?php
$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/bootstrap-multiselect.js', ['depends' => [JqueryAsset::className()]]);
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/bootstrap-multiselect.css', []);
?>