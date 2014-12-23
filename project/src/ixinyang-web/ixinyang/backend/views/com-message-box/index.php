<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComMessageBoxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '推送消息';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-message-box-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'id' => 'messageFrom']); ?>
    <div class="form-group">
        <label for="title">消息标题：</label>
        <?= Html::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => '消息标题']) ?>
    </div>
    <div class="form-group">
        <label for="content">推送内容：</label>
        <?= Html::textarea('content', null, ['class' => 'form-control', 'placeholder' => '推送内容']) ?>
    </div>
    <div style="border: solid 1px #ccc" class="form-group">
        <div class="form-group">
            <div style="margin-left: 18px;margin-top: 5px">
                <label for="content">选择推送群体：</label>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">会员等级：</label>

            <div class="col-sm-8">
                <?= Html::dropDownList('memberGrade', null, ArrayHelper::map($memberRule, 'id', 'memberName'), ['prompt' => '-所有会员-', 'class' => 'form-control']) ?>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">性别：</label>

            <div class="col-sm-8">
                <select id="disabledSelect" name="sex" class="form-control">
                    <option value="">-所有-</option>
                    <option value="0">女</option>
                    <option value="1">男</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">年龄区间：</label>

            <div class="col-sm-4">
                <select id="disabledSelect" name="fromAge" class="form-control">
                    <option value="">-无限制-</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                </select>
            </div>
            <div class="col-sm-4">
                <select id="disabledSelect" name="toAge" class="form-control">
                    <option value="">-无限制-</option>
                    <option value="20">20</option>
                    <option value="25">25</option>
                    <option value="30">30</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-5">
            <?= Html::button('确认推送', ['class' => 'btn btn-primary btn-lg', 'onClick' => 'sendMessage()']) ?>
            <!--            <button type="button" onclick="sendMessage()" class="btn btn-primary btn-lg">确认推送</button>-->
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<script>
    function sendMessage() {
        $.ajax({
            url: 'index.php?r=com-message-box/send',
            type: 'post',
            data: $("#messageFrom").serialize(),
            success: function () {

            },
            error: function () {

            }
        });
    }
</script>
