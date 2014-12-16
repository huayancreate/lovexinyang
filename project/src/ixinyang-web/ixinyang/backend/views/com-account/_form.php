<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-accoun-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'id' => 'accountForm']); ?>
    <div class="col-lg-5">
        <?= $form->field($model, 'userName')->textInput(['maxlencontrol-labelgth' => 50, "readonly" => $model->isNewRecord ? false : true]) ?>
        <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>
        <?= $form->field($model, 'sex')->inline()->radioList(['男' => '男', '女' => '女']) ?>
        <?php $role->roleName = $roleId ?>
        <?= $form->field($role, 'roleName')->dropDownList(ArrayHelper::map($roles, 'id', 'roleName'), ['multiple' => "multiple"]) ?>
        <?= $form->field($role, 'roleName')->hiddenInput(['id' => 'roleId'])->label(false) ?>
    </div>

    <div class="col-lg-5">
        <?= $form->field($model, 'nickname')->textInput(['maxlength' => 50]) ?>
        <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>
        <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => 20]) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
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
    });
</script>

