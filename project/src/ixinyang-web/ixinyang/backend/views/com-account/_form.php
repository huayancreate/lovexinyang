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
        <?= $form->field($model, 'userName')->textInput(['maxlencontrol-labelgth' => 50, "readonly" =>true]) ?>
        <?= $form->field($model, 'email')->textInput([ 'maxlength' => 50]) ?>
        <?= $form->field($model, 'sex')->inline()->radioList(['男' => '男', '女' => '女']) ?>
    </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'nickname')->textInput(['maxlength' => 50]) ?>
        <?= $form->field($model, 'address')->textarea(['maxlength' => 200]) ?>
        <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => 20]) ?>
    </div>

    <div class="col-lg-7">
        <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?= \yii\helpers\Html::errorSummary($model) ?>
<script type="text/javascript">
   /* $(document).ready(function () {
        var value = "";
        $('#authitem-name').multiselect({
            onChange: function (option, checked, select) {
                if (checked === true) {
                    value += option.val() + ",";
                }
                else if (checked === false) {
                    value = value.replace(option.val() + ",", "");
                }
                $("#authitem-name").val(value);
            }
        });

        var roleId = $("#authitem-name").val();
        if (roleId != "0" && roleId!=null) {
            if (roleId.indexOf(",") >= 0) {
                var arr = roleId.split(',');
                for (var i = 0; i < arr.length; i++) {
                    $('#authitem-name').multiselect('select', arr[i], true);
                }
            } else {
                $('#authitem-name').multiselect('select', roleId, true);
            }
        }

        
            
        $("form").validation(function (obj, params) {
                if (obj.id == 'comaccount-username' && $(obj).attr("readonly") == undefined) {
                    $.post("index.php?r=com-account/username", {username: $(obj).val()}, function (data) {
                        params.err = !data.success;
                        params.msg = data.msg;
                    }, "json");
                }
            },
            {reqmark: false}
        );
        
    });*/
</script>

