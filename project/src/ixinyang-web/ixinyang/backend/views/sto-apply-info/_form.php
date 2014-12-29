<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use cliff363825\kindeditor\KindEditorWidget;
use yii\jui\Dialog;
use yii\web\jqueryAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\StoApplyInfo */
/* @var $form yii\widgets\ActiveForm */
?>
<div style="margin-left: -160px">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 250]) ?>
    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>
    <?= $form->field($model, 'otherContact')->textInput(['maxlength' => 50]) ?>
    <?= $form->field($model, 'storeName')->textInput(['maxlength' => 250]) ?>
    <?= $form->field($model, 'city')->dropDownList(ArrayHelper::map($citys, 'id', 'cityCenterName'), ['prompt' => '--城市--']) ?>
    <?= $form->field($model, 'regional')->dropDownList([], ['prompt' => '--区域--']) ?>
    <?= $form->field($model, 'businessZone')->dropDownList([], ['prompt' => '--商圈--']) ?>
    <?= $form->field($model, 'address')->textArea(['maxlength' => 250]) ?>
    <div class="col-lg-offset-4">
        <div class="form-group">
            <?= Html::button('在地图上标注', ['class' => 'btn btn-warning', 'id' => 'map_button']) ?>
            <label id="loglat" style="margin-left:5px;color:red;"></label>
        </div>
    </div>
    <?= $form->field($model, 'storePhone')->textInput() ?>
    <?= $form->field($model, 'daySales')->textInput() ?>
    <div class="form-group field-stoapplyinfo-storecategoryid required">
        <label class="control-label col-sm-3" for="storeCategoryId">商家类型</label>

        <div class="col-sm-6" style="position: relative">
            <?= Html::input("text", null, null, ['id' => 'storeCategoryId', 'class' => 'form-control']) ?>
            <div id="menuContent" class="menuContent" style="display:none; position:absolute;z-index:1;width: 80%;">
                <ul id="treeDemo" class="ztree" style="width:100%;height:300px"></ul>
            </div>
            <?= $form->field($model, 'storeCategoryId')->hiddenInput()->label(false) ?>
        </div>
    </div>
    <?= $form->field($model, 'scopeBusiness')->widget(\cliff363825\kindeditor\KindEditorWidget::className(), [
        'clientOptions' => [
            'width' => '680px',
            'height' => '380px',
            'themeType' => 'default',
            'itemType' => 'full',
            'langType' => 'zh_CN',
            'autoHeightMode' => true,
            'allowImageUpload' => true,
            'filePostName' => 'fileData',
            //'uploadJson' => Url::to(['upload']),
        ],
    ]);
    ?>
    <div class="col-lg-offset-5">
        <div class="form-group">
            <?= Html::submitButton('提交申请', ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?= $form->field($model, 'longitude')->hiddenInput()->label('') ?>
    <?= $form->field($model, 'latitude')->hiddenInput()->label('') ?>

    <?php ActiveForm::end(); ?>
</div>
<?php
Dialog::begin([
    'id' => 'mapDiaLog',
    'clientOptions' => ['modal' => true, 'autoOpen' => false],]);
?>

<?php
Dialog::end();
?>

<script type='text/javascript'>
    <?php
      $this->beginBlock('JS_END');
    ?>
    //级联菜单
    $("#stoapplyinfo-city").change(function () {
        var cityId = $(this).val();
        getCountry(cityId);
    });

    function getCountry(cityId) {
        $.ajax({
            type: "POST",
            data: {'cityId': cityId},
            url: "index.php?r=sto-apply-info%2Fcountry",
            dataType: "json",
            success: function (countrys) {
                $("#stoapplyinfo-regional").empty();
                $("#stoapplyinfo-regional").append("<option value='0'>-" + "-区域-" + "-</option>");
                jQuery.each(countrys, function (idx, item) {
                    $("#stoapplyinfo-regional").append("<option value='" + item.countyId + "'>" + item.countyName + "</option>");
                });
            }
        });
    }

    $("#stoapplyinfo-regional").change(function () {
        var countryId = $(this).val();
        getBusiness(countryId);
    });

    function getBusiness(countryId) {
        $.ajax({
            type: "POST",
            data: {'countryId': countryId},
            url: "index.php?r=sto-apply-info%2Fbusiness",
            dataType: "json",
            success: function (business) {
                $("#stoapplyinfo-businesszone").empty();
                $("#stoapplyinfo-businesszone").append("<option value='0'>-" + "-商圈-" + "-</option>");
                $("#stoapplyinfo-businesszone").css('width', "120");
                jQuery.each(business, function (idx, item) {
                    $("#stoapplyinfo-businesszone").append("<option value='" + item.businessDistrictId + "'>" + item.businessDistrictName + "</option>");
                });
            }
        });
    }

    <?php
      $this->endBlock();
    ?>

</script>
<script type="text/javascript">
    <?php
        $this->beginBlock('JS_END1');
    ?>
    var setting = {
        view: {
            dblClickExpand: false
        },
        async: {
            enable: true,
            url: "index.php?r=sto-apply-info/category"
        },
        data: {
            key: {name: "categoryName"},
            simpleData: {
                enable: true,
                idKey: "id",
                pIdKey: "parentCategoryId"

            }
        },
        callback: {
            beforeClick: beforeClick,
            onClick: onClick
        }
    };

    function beforeClick(treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo");
        zTree.expandNode(treeNode);
    }

    function onClick(e, treeId, treeNode) {
        var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
            nodes = zTree.getSelectedNodes(),
            id = "",
            v = "";

        if (!treeNode.isParent) {
            nodes.sort(function compare(a, b) {
                return a.id - b.id;
            });

            for (var i = 0, l = nodes.length; i < l; i++) {
                v += nodes[i].categoryName + ",";
                id += nodes[i].id + ",";
            }

            if (v.length > 0) v = v.substring(0, v.length - 1);
            var cityObj = $("#storeCategoryId");
            cityObj.attr("value", v);
            $("#stoapplyinfo-storecategoryid").attr("value", id);
            $("#menuContent").fadeOut("fast");
        }
    }

    function showMenu() {
        $("#menuContent").css("display", "block");
        $("body").bind("mousedown", onBodyDown);
    }

    $("#storeCategoryId").click(function () {
        showMenu();
    });

    function hideMenu() {
        $("#menuContent").fadeOut("fast");
        $("body").unbind("mousedown", onBodyDown);
    }
    function onBodyDown(event) {
        if (!(event.target.id == "menuBtn" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length > 0)) {
            hideMenu();
        }
    }

    $(document).ready(function () {
        <!--地图调用-->
        var mapUrl = '<?php echo Yii::$app->urlManager->baseUrl.'/map.html'?>';
        jQuery.showMap('map_button', mapUrl, 'loglat');
        <!--地图调用-->

        $.fn.zTree.init($("#treeDemo"), setting);
    });
    <?php
        $this->endBlock('JS_END1');
    ?>
</script>
<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl . '/css/zTreeStyle.css', []);
$this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END);
$this->registerJs($this->blocks['JS_END1'], \yii\web\View::POS_END);
?>
