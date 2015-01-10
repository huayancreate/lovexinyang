<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/public.css" rel="stylesheet" type="text/css" />
    <link href="css/login_register.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=  Yii::$app->urlManager->baseUrl ?>/assets/43cf4500/css/bootstrap.css">
    <link rel="stylesheet" href="<?=  Yii::$app->urlManager->baseUrl ?>/css/site.css">
    <title>用户注册|爱生活</title>
    <!--[if lt IE9]>
    <script src="js/html5.js"></script>
    <![endif]-->
</head>
<body style="background:url(images/login_bg.png) no-repeat top center">
<header class="top_title">
    <div class="wrap_content_box">
        <div class="top_logo"><a class="logo" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index"><img src="images/register_logo.png" /></a></div>
         <a class="btn1" href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/login">在此登录</a><span>已有帐号?</span>
        <div class="clearfloat"></div>
    </div>
</header>
<!--header  end-->
<section class="wrap_content_box">
    <div class="login_wrap">
        <article class="">
            <div class="login_wrap_left_ico"><img src="images/register_ico.png" /></div>
            <div class="site-signup">

                <?php if($error!=null) {
                    echo '<div class="alert alert-warning alert-dismissible" role="alert" align="center">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <span class="glyphicon glyphicon-exclamation-sign"></span><strong>'.$error.'</strong>
        </div>';
                }
                ?>

                <div class="row">
                    <div >
                        <?php $form = ActiveForm::begin(['id' => 'form-signup','layout' => 'horizontal']); ?>


                        <div class="form-group field-signupform-useraccount required">
                            <label class="control-label col-sm-2" for="signupform-useraccount">用户帐号</label>
                            <div class="col-sm-5 has-feedback">
                                <input id="signupform-useraccount" class="form-control" placeholder="请输入您的手机号作为您的登录帐号"  type="text" name="SignupForm[userAccount]">
                                <span class="glyphicon field-signupform-useraccount form-control-feedback"></span>
                            </div>
                            <div class="help-block help-block-error "></div>
                        </div>


                        <div class="form-group field-signupform-verifycode" style="display: none;">
                            <label class="control-label col-sm-2" for="signupform-verifyCode">图形验证码</label>
                            <div class="col-sm-5 has-feedback ">
                                <?= Captcha::widget(['name'=>'SignupForm[verifyCode]','id'=>'signupform-verifycode',
                                    'template' => '<div class="row"><div class="col-lg-6">{input}<span class="glyphicon field-signupform-verifycode form-control-feedback"></span></div><div class="col-lg-3">{image}</div></div> ',
                                ]) ?>
                            </div>
                            <div class="help-block help-block-error ">请输入图形验证码</div>
                        </div>
                        <div class="form-group field-signupform-code required">
                            <label class="control-label col-sm-2" for="signupform-code">短信动态码</label>
                            <div class="col-sm-5 has-feedback">
                                <input id="signupform-code" class="form-control" type="text" name="SignupForm[code]">
                                <span class="glyphicon field-signupform-code form-control-feedback"></span>
                                <input id="sendcode" class="btn-normal btn-mini " type="button" value="免费获取短信动态码">
                                <span style="font-size: 12px;color: #666;" id="codeTips"></span>
                            </div>
                            <div class="help-block help-block-error "></div>
                        </div>
                        <div class="form-group field-signupform-userpassword required">
                            <label class="control-label col-sm-2" for="signupform-userpassword">创建密码</label>
                            <div class="col-sm-5 has-feedback">
                                <input id="signupform-userpassword" class="form-control" type="password" name="SignupForm[userPassWord]">
                                <span class="glyphicon field-signupform-userpassword form-control-feedback"></span>
                            </div>
                            <div class="help-block help-block-error "></div>
                        </div>
                        <div class="form-group field-signupform-password_reset required">
                            <label class="control-label col-sm-2" for="signupform-password_reset">确认密码</label>
                            <div class="col-sm-5 has-feedback">
                                <input id="signupform-password_reset" class="form-control" type="password" name="SignupForm[password_reset]">
                                <span class="glyphicon field-signupform-password_reset form-control-feedback"></span>
                            </div>
                            <div class="help-block help-block-error "></div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btnlogin" name="signup-button" type="button" onclick="reg()">同意以下协议并注册</button>
                        </div>
                        <a class="f1" target="_blank" href="">《爱信阳用户协议》</a>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>
        </article>
    </div>
</section>
<!--section  主体内容  end-->
<footer>
    <div class="wrap_content_box footer_bottom">
        <address class="footer_bottom_up">Copyright&nbsp;&copy;&nbsp;2014<a href="#">爱信阳</a>版权所有<a href="#">皖ICP备201400001号</a><a href="#">京公网安备11010502025545号</a><a href="#">电子公告服务规则</a>技术支持：<a href="http://www.huayancreate.com" target="_blank">安徽华研电子科技</a></address>
        <div class="footer_bottom_down"><a href="#" target="_blank"><img src="images/footer01.jpg" /></a><a href="#" target="_blank"><img src="images/footer02.jpg" /></a><a href="#" target="_blank"><img src="images/footer03.jpg" /></a><a href="#" target="_blank"><img src="images/footer04.jpg" /></a></div>
    </div><!--footer_bottom  end-->
</footer>
<!--footer  end-->
</body>
</html>



    <script type="text/javascript">
        <?php $this->beginBlock('JS_END'); ?>
        var isSubmit = false;

        <?php
             $validate = $model->getActiveValidators('verifyCode');
            $captcha = $validate[0] ->createCaptchaAction();
            $code = $captcha->getVerifyCode(false);
            $hash = $captcha->generateValidationHash($code);
            echo 'function imgvalicode(){
                jQuery("#form-signup").yiiActiveForm("add",{"id":"signupform-verifycode","name":"verifyCode","container":".field-signupform-verifycode","input":"#signupform-verifycode","error":".help-block.help-block-error",
                            "validate":function (attribute, value, messages, deferred) {
                                yii.validation.captcha(value, messages, {"hash":'.$hash.',"hashKey":"yiiCaptcha\/site\/captcha","caseSensitive":false,"message":"\u9a8c\u8bc1\u7801\u4e0d\u6b63\u786e\u3002"});}
                        });
            }';
        ?>

        jQuery(document).ready(function () {
            jQuery('#form-signup').yiiActiveForm(
                [{"id":"signupform-useraccount","name":"userAccount","container":".field-signupform-useraccount","input":"#signupform-useraccount","error":".help-block.help-block-error",
                    "validate":function (attribute, value, messages, deferred) {
                        yii.validation.required(value, messages, {"message":"\u7528\u6237\u5e10\u53f7\u4e0d\u80fd\u4e3a\u7a7a\u3002"});
                        yii.validation.regularExpression(value, messages, {"pattern":/^1[0-9]{10}$/,"not":false,"message":"\u7528\u6237\u5e10\u53f7\u5fc5\u987b\u4e3a1\u5f00\u5934\u7684\u624b\u673a\u53f7","skipOnEmpty":1});
                    }
                },
                    {"id":"signupform-userpassword","name":"userPassWord","container":".field-signupform-userpassword","input":"#signupform-userpassword","error":".help-block.help-block-error",
                        "validate":function (attribute, value, messages, deferred) {
                            yii.validation.required(value, messages, {"message":"\u8bf7\u586b\u5199\u5bc6\u7801"});
                            yii.validation.string(value, messages, {"message":"\u521b\u5efa\u5bc6\u7801\u5fc5\u987b\u662f\u4e00\u6761\u5b57\u7b26\u4e32\u3002","min":6,"tooShort":"\u521b\u5efa\u5bc6\u7801\u5e94\u8be5\u5305\u542b\u81f3\u5c116\u4e2a\u5b57\u7b26\u3002",
                                "max":24,"tooLong":"\u521b\u5efa\u5bc6\u7801\u53ea\u80fd\u5305\u542b\u81f3\u591a24\u4e2a\u5b57\u7b26\u3002","skipOnEmpty":1});
                        }
                    },
                    {"id":"signupform-password_reset","name":"password_reset","container":".field-signupform-password_reset","input":"#signupform-password_reset","error":".help-block.help-block-error",
                        "validate":function (attribute, value, messages, deferred) {
                            yii.validation.required(value, messages, {"message":"\u8bf7\u518d\u6b21\u586b\u5199\u5bc6\u7801"});
                            yii.validation.string(value, messages, {"message":"\u786e\u8ba4\u5bc6\u7801\u5fc5\u987b\u662f\u4e00\u6761\u5b57\u7b26\u4e32\u3002","min":6,"tooShort":"\u786e\u8ba4\u5bc6\u7801\u5e94\u8be5\u5305\u542b\u81f3\u5c116\u4e2a\u5b57\u7b26\u3002","skipOnEmpty":1});
                            yii.validation.compare(value, messages, {"operator":"==","type":"string","compareAttribute":"signupform-userpassword","skipOnEmpty":1,"message":"\u4e24\u6b21\u5bc6\u7801\u4e0d\u4e00\u81f4"});
                        }
                    },
                    {"id":"signupform-code","name":"code","container":".field-signupform-code","input":"#signupform-code","error":".help-block.help-block-error",
                        "validate":function (attribute, value, messages, deferred) {
                            yii.validation.required(value, messages, {"message":"\u77ed\u4fe1\u52a8\u6001\u7801\u4e0d\u80fd\u4e3a\u7a7a\u3002"});
                        }
                    }
                ], []);

            $('#sendcode').on('click',function(){
                validateinput();
            });

            <?php
                if(Yii::$app->session['__validateCode_count'] > 3 ){
                    echo  '
                    imgvalicode();
                    setTimeout("$(\'#signupform-verifycode-image\').click()",1);
                    $(".field-signupform-verifycode").show();';
                }
            ?>


        });


        function validateinput(){
            if( $('.field-signupform-useraccount.glyphicon-ok').length>=1 ){
                var $container =  $('.form-group.field-signupform-useraccount');
                var $error = $container.find(".help-block");
                $.ajax({
                    url: "index.php?r=site/register",
                    type: "post",
                    data: {userAccount:$('#signupform-useraccount').val()},
                    dataType: "json",
                    success: function (msgs) {
                        if (msgs !== null && msgs=='error' ) {
                            $container.removeClass( ' validating  has-success')
                                .addClass('has-error');
                            $container.find('.field-signupform-useraccount').removeClass('glyphicon-ok')
                                .addClass('glyphicon-remove');
                            $error.html('此手机号码已经注册，请直接登录.');
                        }else if(msgs=='success' ){
                            isSubmit = true;
                            sendSmsCode(<?= Html::encode(Yii::$app->session['__validateCode_count']) ?>);
                        }
                    },
                    error: function(msgs){
                        $container.removeClass( ' validating  has-success')
                            .addClass('has-error');
                        $container.find('.field-signupform-useraccount').removeClass('glyphicon-ok')
                            .addClass('glyphicon-remove');
                        $error.html('此号码注册验证出现问题，请稍后重试或联系我们.');
                    }
                });
            }else if($('.field-signupform-useraccount.glyphicon-remove').length == 0 || $('#signupform-useraccount').val() == null){
                var $container =  $('.form-group.field-signupform-useraccount');
                var $error = $container.find(".help-block");
                $container.removeClass( ' validating  has-success')
                    .addClass('has-error');
                $container.find('.field-signupform-useraccount').removeClass('glyphicon-ok')
                    .addClass('glyphicon-remove');
                $error.html("用户帐号不能为空。");
                $('#signupform-useraccount').focus();
            }else{
                $('#signupform-useraccount').focus();
            }
        }

        //主注册流程
        function reg() {
            if(isSubmit==false){
                validateinput();
            }
            $('#form-signup').submit();

        }

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJsFile("assets/ca69e0c4/yii.validation.js"); ?>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>
<?php $this->registerJsFile("js/sendSMS.js"); ?>