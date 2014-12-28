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
    <?= GridView::widget([
        'dataProvider' => $comsumptionProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'orderNo',
            'orderId',
            'goodsId',
            'verfificationCode',
        ],
    ]); ?>
    <div style="border: 1px solid #ccc;padding: 10px 0px 0px 15px">
        <div class="form-group">
            <label class="control-label" for="inputSuccess4">商家转入帐号名称：</label>
            <label class="control-label" for="inputSuccess4">2014090115122</label>
        </div>
        <div class="form-group">
            <label class="control-label" for="inputSuccess4">商家转入帐号：</label>
            <label class="control-label" for="inputSuccess4">2014090115122</label>
        </div>
    </div>
    <div style="margin-top: 15px">
        <?= Html::button('结款', ['class' => 'btn btn-success ', 'onclick' => 'SettleAccounts()']) ?>
    </div>
</div>
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
                data: $('#comsumptionSearch').serialize(),
                async: false,
                error: function (request) {
                    alert("Connection error");
                },
                success: function (data) {
                    //alert(data);
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
                $("#consumptionList").html(data);
            }
        });
    }
</script>
