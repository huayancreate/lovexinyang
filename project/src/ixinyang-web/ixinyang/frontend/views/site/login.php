<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

?>
<?php $this->registerCssFile(Yii::$app->urlManager->baseUrl."/css/login.css"); ?>
<div class="site-login">
    <h1>登录</h1>

    <div class="row">

        <form id="login-form" role="form" method="post" action="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/login" class="form-horizontal templatemo-container col-md-4 ">


            <div  <?php if($error!=null) { echo 'class="div-error has-error"  style="display:block"'; }
            else{echo 'class="div-error"  style="display:none"';} ?>  >
                <div  class="alert alert-danger alert-dismissible" role="alert" style="padding: 0;">
                    <span class="glyphicon glyphicon-exclamation-sign help-block"><?php if($error!=null) { echo $error; } ?></span></div>
            </div>


        <div class="form-group">
            <div class="col-xs-12">
             <div class=" input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" placeholder="帐号|手机号" id="username"  name="LoginForm[username]">
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-xs-12">
                <div class=" input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon glyphicon-lock"></span></span>
                    <input type="password" class="form-control" placeholder="密码" id="password"  name="LoginForm[password]">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="checkbox  input-group">
                    <label>
                        <input type="hidden" value="0" name="LoginForm[rememberMe]">
                        <input id="loginform-rememberme" type="checkbox" checked="" value="1" name="LoginForm[rememberMe]"> 记住我
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                <div class="">
                    <button class="btn btn-primary" name="login-button" type="submit">登录</button>
                    <a class="text-right pull-right" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site%2Frequest-password-reset">忘记密码?</a>
                </div>
            </div>
        </div>
    </form>

    </div>
</div>

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
<?php $this->registerJsFile("assets/ca69e0c4/yii.activeForm.js"); ?>
<?php $this->registerJsFile("assets/ca69e0c4/yii.validation.js"); ?>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>