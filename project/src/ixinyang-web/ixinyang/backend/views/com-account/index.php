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


$this->title = '账户信息';
$this->params['breadcrumbs'][] = '账号管理';
?>
    <div class="com-category-maintain-index">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <p>
            <!-- <?= Html::a('创建账号', 'javascript:void(0)', ['class' => 'btn btn-success', 'onClick' => 'View("创建账号","com-account/create")']) ?> -->
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
                                        'onClick' => 'Detail("账号查看","com-account/view&id=' . $model['id'] . '")'
                                    ]);
                            },
                            'update' => function ($url, $model) {
                                $person = ComPersonRolerelation::find()->where(['personId' => $model['id']])->one();
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'Update'),
                                        'data-pjax' => true,
                                        'onClick' => 'View("账号修改","com-account/update&id=' . $model['id'] . '")'
                                    ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'javascript:void(0)',
                                    [
                                        'title' => Yii::t('yii', 'Delete'),
                                        'data-pjax' => true,
                                        'onClick' => 'Delete("com-account/delete&id=' . $model['id'] . '")'
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
            'clientOptions' => ['modal' => true, 'autoOpen' => false, 'width' => '800', 'height' => '600'],]);
        ?>
        <div id="view"></div>
        <?php
        Dialog::end();
        ?>
    </div>
    <script type="text/javascript">
       /* function View(title, url) {
            JuiDialog.showDialogWithValid('viewDialog', title, url, url, 'accountForm', 'accountList');
        }*/
        function Detail(title, url) {
            $("#viewDialog").empty();
            JuiDialog.dialogView("viewDialog", title, url);
        }
        function Delete(url) {
            bootbox.confirm("是否确定删除?", function (result) {
                if (result) {
                    JuiDialog.del(url, "accountList");
                }
            });
        }

        function View(title, url){
            //加载创建账号页面
            getCreateInfo(url);
            $("#viewDialog").dialog("open");
            $("#viewDialog").dialog({
                            autoOpen:false,
                            modal: true,
                            title:title,
                            show: "blind",             //show:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                            hide: "explode",       //hide:"blind",clip,drop,explode,fold,puff,slide,scale,size,pulsate  所呈现的效果
                            resizable: true,
                            overlay: {
                                opacity: 0.5,
                                background: "black",
                                overflow: 'auto'
                            },
                        buttons: {
                         
                        },
                        close: function () {
                            $("#viewDialog").dialog("close");
                        },  
                      });
        }

        //弹出dialog 添加对话框
        function getCreateInfo(url){
             $.ajax({
                 type:"post",
                 url:"index.php?r="+url,
                 success:function(data) {
                    $("#viewDialog").html(data);
                 }
               });
        }
    </script>
<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/bootstrap-multiselect.css', []);
$this->registerJsFile(Yii::$app->urlManager->baseUrl . '/js/bootstrap-multiselect.js', ['depends' => [JqueryAsset::className()]]);
?>
