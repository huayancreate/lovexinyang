<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

?>
    <link href="css/public.css" rel="stylesheet" type="text/css" />
    <link href="css/login_register.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?=  Yii::$app->urlManager->baseUrl ?>/css/site.css">
    <title>登录|爱生活</title>
</head>
<body style="background:url(<?=  Yii::$app->urlManager->baseUrl ?>/images/login_bg.png) no-repeat top center">
<header class="top_title">
    <div class="wrap_content_box">
        <div class="top_logo"><a class="logo" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index"><img src="images/login_logo.png" /></a></div>

    </div>
</header>
<!--header  end-->
<section class="wrap_content_box">
    <div class="login_wrap">
        <article class="login_wrap_left">
            <div class="login_wrap_left_ico"><img src="images/login_ico.png" /></div>
            <div class="row">
                <form id="login-form" role="form" method="post" action="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/login" class="form-horizontal templatemo-container  ">
                    <div  <?php if($error!=null) { echo 'class="div-error has-error"  style="display:block"'; }
                    else{echo 'class="div-error"  style="display:none"';} ?>  >
                        <div  class="alert alert-danger alert-dismissible" role="alert" style="padding: 0;">
                            <span class="glyphicon glyphicon-exclamation-sign help-block"><?php if($error!=null) { echo $error; } ?></span></div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class=" input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="text" class="form-control" placeholder="帐号(手机号)" id="username"  name="LoginForm[username]">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class=" input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></span>
                                <input type="password" class="form-control" placeholder="密码"  id="password"  name="LoginForm[password]">
                            </div>
                        </div>
                    </div>

                    <p><input class="autologin" id="loginform-rememberme" type="checkbox"  value="1" name="LoginForm[rememberMe]" />记住我<a class="rgt" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site%2Frequest-password-reset">忘记密码？</a></p>
                    <input class="btn1" type="submit" value="登录" />

                </form>

            </div>
            <p>还没有爱信阳账号？<i><a href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site%2Fsignup">立即注册</a></i></p>
        </article>
        <article class="login_wrap_right">
            <a href="javascript:void(0)"><img src="images/login_ad01.jpg" /></a>
        </article>
        <div class="clearfloat"></div>
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



<script type="text/javascript">
    <?php $this->beginBlock('JS_END'); ?>
    jQuery(document).ready(function () {
        jQuery('#login-form').yiiActiveForm(
            [{"id":"password","name":"password","container":".div-error",
                "input":"#password", "error":".help-block",
                "validate":function (attribute, value, messages, deferred) {
                    yii.validation.required(value, messages, {"message":"帐号或密码\u4e0d\u80fd\u4e3a\u7a7a\u3002"});
                }
            },{"id":"username","name":"username","container":".div-error",
                "input":"#username","error":".help-block",
                "validate":function (attribute, value, messages, deferred) {
                    yii.validation.required(value, messages, {"message":"帐号或密码\u4e0d\u80fd\u4e3a\u7a7a\u3002"});
                    yii.validation.regularExpression(value, messages, {"pattern":/^1[0-9]{10}$/,"not":false,"message":"\u7528\u6237\u5e10\u53f7\u5fc5\u987b\u4e3a1\u5f00\u5934\u7684\u624b\u673a\u53f7","skipOnEmpty":1});
                }
            }
            ], []);
    });
    <?php $this->endBlock(); ?>
</script>

<?php $this->registerJsFile("assets/41bf18e/jquery.min.js"); ?>
<?php $this->registerJsFile("assets/ca69e0c4/yii.activeForm.js"); ?>
<?php $this->registerJsFile("assets/ca69e0c4/yii.validation.js"); ?>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>

</body>
</html>