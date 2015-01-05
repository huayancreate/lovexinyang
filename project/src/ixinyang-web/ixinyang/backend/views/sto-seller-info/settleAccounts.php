<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-14
 * Time: 10:27
 */

use yii\helpers\Html;
use yii\grid\GridView;

?>
<div id="consumptionList">
    <label>总计：(￥) <?php echo $comsumptionModel->payablePrice ?></label>
    <?php \yii\widgets\Pjax::begin(['id' => 'test']); ?>
    <?= GridView::widget([
        'dataProvider' => $comsumptionProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'orderNo',
            'orderId',
            'goodsId',
            'verfificationCode',
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
    <div style="border: 1px solid #ccc;padding: 10px 0px 0px 15px">
        <div class="form-group">
            <label class="control-label" for="inputSuccess4">商家名称：</label>
            <label class="control-label" for="inputSuccess4"><?php echo $comsumptionModel->sellerName ?></label>
        </div>
        <div class="form-group">
            <label class="control-label" for="inputSuccess4">商家转入帐号：</label>
            <label class="control-label" for="inputSuccess4"><?php echo $comsumptionModel->sellerAccount ?></label>
        </div>
    </div>
    <div style="margin-top: 15px">
        <?= Html::button('结款', ['id' => 'settAccounts', 'class' => 'btn btn-success ', 'onclick' => 'SettleAccounts()']) ?>
    </div>
</div>
<script type="text/javascript">

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
                dataType: "json",
                url: "index.php?r=sto-seller-info/settle",
                data: $('#comsumptionSearch').serialize(),
                async: false,
                error: function (request) {
                    alert("Connection error");
                },
                success: function (data) {
                    if (data.msg == "success") {
                        bootbox.alert("结款成功", function () {
                            $("#settAccounts").attr("disabled", "disabled");
                        });
                    } else {
                        bootbox.alert("结款成功", function () {
                            $("#settAccounts").attr("disabled", "disabled");
                        });
                    }
                }
            });
        }
    }
    function ComsumptionSearch() {
        $.ajax({
            cache: true,
            type: "POST",
            url: "index.php?r=sto-seller-info/consumption",
            data: $('#comsumptionSearch').serialize(),
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                if (data != "") {
                    $("#consumptionList").html(data);
                    var result = $("#consumptionList").find("div").hasClass("empty");
                    if (!result) {
                        $("#settAccounts").removeAttr("disabled");
                    }
                    else {
                        $("#settAccounts").attr("disabled", "disabled");
                    }
                }
            }
        });
    }
</script>
