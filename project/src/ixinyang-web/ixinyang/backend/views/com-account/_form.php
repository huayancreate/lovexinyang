<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-accoun-form">
    <?php $form = ActiveForm::begin(['id' => 'accountForm']); ?>
    <div class="col-lg-6">
        <?= $form->field($model, 'userName')->textInput(['id' => 'username', 'maxlencontrol-labelgth' => 50, "readonly" => $model->isNewRecord ? false : true, 'check-type' => 'required', 'required-message' => '账号不能为空']) ?>
        <?= $form->field($model, 'email')->textInput(['id' => 'mail', 'maxlength' => 50, 'check-type' => 'mail required']) ?>
        <?= $form->field($model, 'sex')->inline()->radioList(['男' => '男', '女' => '女']) ?>
        <?php $role->roleName = $roleId ?>
        <?= $form->field($role, 'roleName')->dropDownList(ArrayHelper::map($roles, 'id', 'roleName'), ['multiple' => "multiple"]) ?>
        <?= $form->field($role, 'roleName')->hiddenInput(['id' => 'roleId'])->label(false) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'nickname')->textInput(['maxlength' => 50, 'check-type' => 'required', 'required-message' => '昵称不能为空']) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => 200, 'check-type' => 'required', 'required-message' => '地址不能为空']) ?>
        <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => 20, 'check-type' => 'phone required', 'required-message' => '手机不能为空']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?= \yii\helpers\Html::errorSummary($model) ?>
<script type="text/javascript">
    $(document).ready(function () {
        var value = "";
        $('#comrole-rolename').multiselect({
            onChange: function (option, checked, select) {
                if (checked === true) {
                    value += option.val() + ",";
                }
                else if (checked === false) {
                    value = value.replace(option.val() + ",", "");
                }
                $("#roleId").val(value);
            }
        });

        var roleId = $("#roleId").val();
        if (roleId != "0") {
            if (roleId.indexOf(",") >= 0) {
                var arr = roleId.split(',');
                for (var i = 0; i < arr.length; i++) {
                    $('#comrole-rolename').multiselect('select', arr[i], true);
                }
            } else {
                $('#comrole-rolename').multiselect('select', roleId, true);
            }
        }

        $(function () {
            //$("form").validation();
            $("form").validation(function (obj, params) {
                    if (obj.id == 'username' && $(obj).attr("readonly") == undefined) {
                        $.post("index.php?r=com-account/username", {username: $(obj).val()}, function (data) {
                            params.err = !data.success;
                            params.msg = data.msg;
                        }, "json");
                    }
                },
                {reqmark: false}
            );
        });
    });
</script>

