<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-14
 * Time: 10:27
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\daterange\DateRangePicker;


$this->title = 'Sto Seller Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin([
    'id' => 'settleAccount',
    'action' => ['settle'],
    'method' => 'post',
    'layout' => 'horizontal'
]);
?>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">请选择时间范围:</label>

    <div id="dateRange" class="col-sm-7">
        <?php
        echo DateRangePicker::widget([
            'name' => 'dateRange',
            'convertFormat' => true,
            'pluginOptions' => [
                'timePicker' => false,
                'timePickerIncrement' => 15,
                'format' => 'Y-m-d',
                'separator' => ' to ',
                'minDate' => $model,
                //'singleDatePicker'=>true,
            ]
        ]);
        ?>
    </div>

    <?= Html::button('结款', ['class' => 'btn btn-success', 'id' => 'btnSelect', 'onclick' => 'SettleAccounts()']) ?>
</div>

<?php ActiveForm::end(); ?>
<script type="text/javascript">
    $(function () {
        var dateRange = $('input[name="dateRange"]');
        dateRange.attr("readonly", "readonly");
        dateRange.attr("placeholder", "请选择日期范围");
    });
    function SettleAccounts() {
        var dateRange = $('input[name="dateRange"]');
        if (dateRange.val() == "") {
            $("#dateRange").addClass("has-error");
        }
        else {
            $("#dateRange").removeClass("has-error");
            $.ajax({
                cache: true,
                type: "POST",
                url: "index.php?r=sto-seller-info/settle",
                data: $('#settleAccount').serialize(),
                async: false,
                error: function (request) {
                    alert("Connection error");
                },
                success: function (data) {
                    alert(data);
                }
            });
        }

    }
</script>