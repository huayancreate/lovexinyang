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
        <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar"   style="width: 33.3%">
            <h4>1.确认帐号</h4>
        </div>
        <div class="progress-bar progress-bar-striped progress-bar-info"  style="width: 33.4%">
            <h4>2.确认/修改</h4>
        </div>
        <div class="progress-bar progress-bar-striped progress-bar-info"  style="width: 33.3%">
            <h4>3.完成</h4>
        </div>
    </div>

    <div class="panel panel-default" >
        <div class="panel-body " >
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form','layout'=>'horizontal','class'=>'text-center']); ?>
                    <div class="text-center" style="width:400px; margin: 0 auto;">

                        <?php if($error!=null) {
                            echo '<div class="alert has-error alert-danger alert-dismissible "  contenteditable="true" align="center">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <span class="glyphicon glyphicon-exclamation-sign"></span><strong>'.$error.'</strong>
                        </div>';
                        }
                        ?>

                        <div class="field-userAccount required">
                            <div class="  has-feedback ">
                                <div class="form-group input-group col-lg-10">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                    <input type="text" class="form-control" placeholder="帐号|手机号" id="userAccount"  name="userAccount">
                                </div>
                            </div>
                            <div class="help-block help-block-error "></div>
                        </div>

                        <div class="form-group field-verifyCode" >
                            <div class="  has-feedback ">
                                <?= Captcha::widget(['name'=>'verifyCode','id'=>'verifyCode',
                                    'template' => '<div class="row"><div class="col-lg-6" ><div class=" input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>{input}<span class="glyphicon field-signupform-verifycode form-control-feedback"></span></div></div><div class="col-lg-3">{image}</div></div> ',
                                ]) ?>
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
        var isSubmit = false;
        jQuery(document).ready(function () {
            jQuery('#request-password-reset-form').yiiActiveForm(
                [{"id":"userAccount","name":"userAccount","container":".field-userAccount","input":"#userAccount","error":".help-block.help-block-error",
                    "validate":function (attribute, value, messages, deferred) {
                        yii.validation.required(value, messages, {"message":"\u7528\u6237\u5e10\u53f7\u4e0d\u80fd\u4e3a\u7a7a\u3002"});
                        yii.validation.regularExpression(value, messages, {"pattern":/^1[0-9]{10}$/,"not":false,"message":"\u7528\u6237\u5e10\u53f7\u5fc5\u987b\u4e3a1\u5f00\u5934\u7684\u624b\u673a\u53f7","skipOnEmpty":1});
                    }
                },
                    {"id":"verifyCode","name":"verifyCode","container":".field-verifyCode","input":"#verifyCode","error":".help-block.help-block-error",
                        "validate":function (attribute, value, messages, deferred) {
                            yii.validation.captcha(value, messages, {"hash":'',"hashKey":"yiiCaptcha\/site\/captcha","caseSensitive":false,"message":"\u9a8c\u8bc1\u7801\u4e0d\u6b63\u786e\u3002"});}
                    }
                ], []);

            $('#sendcode').on('click',function(){
                validateinput();
            });


            setTimeout("$(\'#verifyCode-image\').click()",1);


        });

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJsFile("assets/ca69e0c4/yii.validation.js"); ?>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>
<?php $this->registerJsFile("js/sendSMS.js"); ?>