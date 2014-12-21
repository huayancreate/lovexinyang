<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = '找回密码';
?>
    <div class="site-request-password-reset">
        <h1>找回密码</h1>

        <div class="progress" style="height: 35px;">
            <div class="progress-bar progress-bar-striped progress-bar-success"    style="width: 33.3%">
                <h4>1.确认帐号</h4>
            </div>
            <div class="progress-bar progress-bar-striped progress-bar-success "   style="width: 33.4%">
                <h4>2.确认/修改</h4>
            </div>
            <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar"  style="width: 33.3%">
                <h4>3.完成</h4>
            </div>
        </div>

        <div class="panel panel-default" >
            <div class="panel-body " >
                <?php $form = ActiveForm::begin(['id' => 'reset-password','layout'=>'horizontal','action'=>['reset-password'],'class'=>'text-center']); ?>
                <div class="text-center" style="width:400px; margin: 0 auto;">

                    <?php if(Yii::$app->request->get('error') !=null) {
                        echo '<div class="alert has-error alert-danger alert-dismissible " role="alert" align="center">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <span class="glyphicon glyphicon-exclamation-sign"></span><strong>'.$error.'</strong>
                        </div>';
                    }
                    ?>

                    <div  class="form-group">
                        <h4 class="title">您的验证已通过，请立即修改您的登录密码</h4>
                    </div>


                    <div class="form-group field-signupform-userpassword required">
                        <div class="  has-feedback  " style="margin-left: 40px;">
                            <div class="form-group input-group col-lg-10">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="password" class="form-control" placeholder="输入新密码" id="signupform-userpassword"  name="userPassWord">
                            </div>
                        </div>
                        <div class="help-block help-block-error "></div>
                    </div>

                    <div class="form-group field-signupform-password_reset required">
                        <div class="  has-feedback " style="margin-left: 40px;">
                            <div class="form-group input-group col-lg-10">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input type="password" class="form-control" placeholder="确认新密码" id="signupform-password_reset"  name="password_reset">
                            </div>
                        </div>
                        <div class="help-block help-block-error "></div>
                    </div>

                    <div class="form-group ">
                        <?= Html::submitButton('确认', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

        </div>


    </div>



    <script type="text/javascript">
        <?php $this->beginBlock('JS_END'); ?>
        var isSubmit = true;

        jQuery(document).ready(function () {
            jQuery('#reset-password').yiiActiveForm(
                [  {"id":"signupform-userpassword","name":"userPassWord","container":".field-signupform-userpassword","input":"#signupform-userpassword","error":".help-block.help-block-error",
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
                    }
                ], []);

        });

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJsFile("assets/ca69e0c4/yii.validation.js"); ?>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>
<?php $this->registerJsFile("js/sendSMS.js"); ?>