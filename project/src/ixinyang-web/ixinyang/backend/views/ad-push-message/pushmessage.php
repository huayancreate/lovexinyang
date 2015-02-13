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

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'messageFrom']); ?>
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
        <?= Html::textarea('content', null, ['class' => 'form-control', 'placeholder' => '推送详情','id'=>'content']) ?>
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
                <?= Html::dropDownList('cityCenterId', null, ArrayHelper::map($city, 'id', 'cityCenterName'), ['prompt' => '-无限制-', 'class' => 'form-control']) ?>
            </div>
            <div class="col-sm-5">
                <?= Html::dropDownList('area', null, [], ['prompt' => '--无限制--', 'class' => 'form-control']) ?>
            </div>
        </div>
    </div>
    <div class="col-lg-offset-10">

    <div class="form-group">
      
       <?= Html::button("保存",['id'=>'btnSave','class' =>'btn btn-success']) ?>
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
    $("select[name='cityCenterId']").change(function () {
        $.get("index.php?r=ad-push-message/get-county&cityId=" + $(this).val(), function (data) {
            $("select[name='area']").empty();
            jQuery.each(JSON.parse(data), function (index, item) {
                $("select[name='area']").append("<option value='" + item.countyId + "'>" + item.countyName + "</option>");
            });
        });
    });
    $("#btnSave").click(function(){
        var p=checkForm();
        if (p) 
        {
            $.ajax({
                    type:"POST",
                    url:"index.php?r=ad-push-message/send",
                    data:$('#messageFrom').serialize(),
                    dataType:'json',
                error: function (request) {
                    alert("Connection error");
                },
                success:function(data) {
                    if(data.success){
                        //当成功后操作。。
                        $.pjax.reload({container:'#pushMessageGrid'});
                    }else{
                       alert("操作失败");
                    }
                }
            });
        };
    }); 
    function checkForm()
    {
         //推送主题
         var title=$("input[name='title']").val();
         //推送概述
         var introduction=$("input[name='introduction']").val();
         //推送详情
         var content=$("#content").val();

        if (title== "undefined" || title=='') 
         { 
            alert("请输入推送主题");
            return false;
         }
         else if (introduction== "undefined" || introduction=='') 
         { 
            alert("请输入推送概述");
            return false;
         }
          else if (content== "undefined" || content=='') 
         { 
            alert("请输入推送详情");
            return false;
         }
         else{
            return true;
         }
    }
</script>

