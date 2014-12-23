<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-14
 * Time: 12:17
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use kartik\daterange\DateRangePicker;

?>
<div id="refundList">

    <?= GridView::widget([
        'dataProvider' => $refundDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orderName',
            'busiName',
            'applyTime',
            'storeName',
            'refundMoney',
            'userName',
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function Search() {
        $.ajax({
            cache: true,
            type: "post",
            url: "index.php?r=sto-seller-info/refund",
            data: $('#refundSearch').serialize(),
            async: false,
            error: function (request) {
                alert("Connection error");
            },
            success: function (data) {
                $("#refundList").html(data);
            }

        });
    }
</script>