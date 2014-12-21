<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = '找回密码';
?>
<div class="request-password-sms">
    <h1>找回密码</h1>

    <div class="progress" style="height: 35px;">
        <div class="progress-bar progress-bar-striped progress-bar-success"    style="width: 33.3%">
            <h4>1.确认帐号</h4>
        </div>
        <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar"  style="width: 33.4%">
            <h4>2.确认/修改</h4>
        </div>
        <div class="progress-bar progress-bar-striped progress-bar-info"  style="width: 33.3%">
            <h4>3.完成</h4>
        </div>
    </div>

    <div class="panel panel-default" >
        <div class="panel-body " >
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form','layout'=>'horizontal','action'=>['request-password-sms'],'class'=>'text-center']); ?>
                    <div class="text-center" style="width:400px; margin: 0 auto;">

                        <?php if($error !=null) {
                            echo '<div class="alert has-error alert-danger alert-dismissible " role="alert" align="center">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <span class="glyphicon glyphicon-exclamation-sign"></span><strong>'.$error.'</strong>
                        </div>';
                        }
                        ?>

                        <div  >
                            <h3 class="title">为了您的账户安全，请先验证手机</h3>
                        </div>
                        <div class=" ">
                            <label>您的手机号</label>
                            <span class="text  "><?php echo substr_replace( $userAccount,'****',3,4) ?></span>
                        </div>


                        <div class="form-group">
                                <span class="glyphicon"></span>
                                <input id="sendcode" class="btn-normal btn-mini " type="button" value="获取动态码">
                                <span style="font-size: 12px;color: #666;" id="codeTips"></span>
                        </div>

                        <div class="field-code required col-lg-10">
                                <div class=" input-group  "  >
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-eye-open"></span></span>
                                    <input type="text" class="form-control  " placeholder="短信验证码" id="code"  name="code">
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
            jQuery('#request-password-reset-form').yiiActiveForm(
                [{"id":"code","name":"code","container":".field-code","input":"#code","error":".help-block.help-block-error",
                    "validate":function (attribute, value, messages, deferred) {
                        yii.validation.required(value, messages, {"message":"验证码不能为空"});
                        yii.validation.regularExpression(value, messages, {"pattern":/^[0-9]{6}$/,"not":false,"message":"请输入6位数字验证码","skipOnEmpty":1});
                    }
                }
                ], []);


            $('#sendcode').on('click',function(){
                sendSmsCode('','findPassword');
            });

        });

        <?php $this->endBlock(); ?>
    </script>
<?php $this->registerJsFile("assets/ca69e0c4/yii.validation.js"); ?>
<?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_END); ?>
<?php $this->registerJsFile("js/sendSMS.js"); ?>