/**
 * Created by pan on 2014/12/15.
 */
//倒计时
var InterValObj1; //timer变量，控制时间
var count1 = 60; //间隔函数，1秒执行
var curCount1;//当前剩余秒数
//timer处理函数
function setRemainTime() {
    if (curCount1 == 0) {
        window.clearInterval(InterValObj1);//停止计时器
        $("#sendcode").val("免费获取短信动态码");
        $('#codeTips').html('');
        $("#sendcode").attr("disabled",false).removeClass('btn-disabled');
    }else {
        curCount1--;
        $("#sendcode").val("重新获取(" + curCount1 + ")");
    }
}

/**
 * 发送短信  验证操作次数，超过3次需要输入验证码
 * @param val
 */
function sendSmsCode(val,sign) {
    if (isSubmit == true) {
        if( (val>3 || $('div.field-signupform-verifycode').css("display")=='block') && $('.field-signupform-verifycode.glyphicon-ok').length< 1){
            var $container =  $('.form-group.field-signupform-verifycode');
            var $error = $container.find(".help-block");
            $container.removeClass( ' validating  has-success')
                .addClass('has-error');
            $container.find('.field-signupform-useraccount').removeClass('glyphicon-ok')
                .addClass('glyphicon-remove');
            $error.html('您的操作过于频繁，请先输入图形验证码，再获取短信动态码');
            return;
        }
        $.ajax({
            type: "POST",
            cache: false,
            url: "index.php?r=site/send",
            data: {useraccount: $('#signupform-useraccount').val(),imageCode:$('#signupform-verifycode').val(),sign:sign==null?'':sign},
            dataType: "json",
            success: function (msgs) {
                var data = eval(msgs);
                if(data.count !==null && data.count > 3){
                    imgvalicode();
                    $('#signupform-verifycode-image').click();
                    $('.field-signupform-verifycode').show();
                }
                 if (data.result !== null && data.result == true) {
                    $('#sendcode').addClass('btn-disabled');
                    $('#sendcode').attr("disabled", true);
                    $('#codeTips').html('已发送，1分钟后可重新获取。');
                    $('#signupform-verifycode-image').click();
                    curCount1 = count1;
                    InterValObj1 = window.setInterval(setRemainTime, 1000); //启动计时器，1秒执行一次
                } else {
                     $('#signupform-verifycode-image').click();
                     $('#codeTips').html( data.msg!=null ? data.msg: "获取短信验证码有误，请重试!");
                }
            },
            error:function(textStatus,msg){
            }
        });
    }


}