<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-12-25
 * Time: 14:07
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = '推送消息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-message-box-index">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'id' => 'messageFrom']); ?>
    <div class="form-group col-sm-12">
        <label for="title">推送主题：</label>
        <?= Html::input('text', 'title', null, ['class' => 'form-control input-mini', 'placeholder' => '推送主题']) ?>
    </div>
    <div class="form-group col-sm-12">
        <label for="title">推送概述：</label>
        <?= Html::input('text', 'introduction', null, ['class' => 'form-control', 'placeholder' => '推送概述']) ?>
    </div>
    <div class="form-group col-sm-12">
        <label for="content">推送详情：</label>
        <?= Html::textarea('content', null, ['class' => 'form-control', 'placeholder' => '推送详情']) ?>
    </div>
    <div class="form-group">
        <div class="form-group col-sm-12">
            <div style="margin-left: 18px;margin-top: 5px">
                <label for="content">选择推送群体：</label>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label for="inputEmail3" class="col-sm-2 control-label">性别：</label>

            <div class="col-sm-10">
                <select name="sex" class="form-control">
                    <option value="">-所有-</option>
                    <option value="0">女</option>
                    <option value="1">男</option>
                </select>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label for="inputEmail3" class="col-sm-2 control-label">年龄区间：</label>

            <div class="col-sm-5">
                <select id="fromAge" name="fromAge" class="form-control">
                    <option value="">-无限制-</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
            </div>
            <div class="col-sm-5">
                <select id="toAge" name="toAge" class="form-control">
                    <option value="">-无限制-</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                </select>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <label for="inputEmail3" class="col-sm-2 control-label">地区：</label>

            <div class="col-sm-5">
                <select id="disabledSelect" name="city" class="form-control">
                    <option value="">-无限制-</option>
                    <option value="15">信阳市</option>
                </select>
            </div>
            <div class="col-sm-5">
                <select id="disabledSelect" name="area" class="form-control">
                    <option value="">-无限制-</option>
                    <option value="20">平台区</option>
                    <option value="25">固始县</option>
                    <option value="30">光山县</option>
                </select>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    $('#fromAge').change(function () {
        var fromAge = $(this).val();
        var toAge = $("#toAge").val();
        if (toAge != "") {
            if (fromAge > toAge) {
                alert("起始年龄不能大于结束年龄");
                $("#fromAge")[0].selectedIndex = 0;
            }
        }
    });
    $('#toAge').change(function () {
        var toAge = $(this).val();
        var fromAge = $("#fromAge").val();
        if (fromAge != "") {
            if (fromAge > toAge) {
                alert("结束年龄不能小于起始年龄");
                $("#toAge")[0].selectedIndex = 0;
            }
        }
    });
</script>

