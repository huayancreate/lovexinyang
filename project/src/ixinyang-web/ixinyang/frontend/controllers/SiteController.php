<?php
namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\rest\Action;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\models\CusUserAccount;
use common\hycommon\tool\GenerateValidateCode;
use common\hycommon\tool\SendPhoneSMS;
use common\hycommon\tool\SendSocketMessage;

use yii\web\Session;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $result['msg'] = '';

        if ($model->load(Yii::$app->request->post())) {
            $result =  $model->login();
            //处理ajax请求认证
            if($result['code'] === true){
                SendSocketMessage::loginMsg($model->getUser()->userAccount);
            }
            if(Yii::$app->request->post('token')==='ajax'){
                return json_encode($result);
            }
            if($result['code'] === true){
                return $this->goBack();
            }
        }
        return $this->render('login', [
                'model' => $model,'error' => $result['msg']
            ]);

    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        $error = '';
        if ($model->load(Yii::$app->request->post())) {
            $session = Yii::$app->getSession();
            $session->open();
            $validate = new GenerateValidateCode();
            if($session[$validate->name]==null){
                $error = '获取短信动态码有误，请重新获取';
            }elseif($validate->validate($model->code)==false){
                $error = '手机动态码错误，请重新输入';
            }elseif($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,'error' =>$error
        ]);
    }

    /*验证注册*/
    public function actionRegister()
    {
        $username = $_POST['userAccount'];
        $model = new CusUserAccount();
        if ($model->findByUsername($username))
            return json_encode("error");
        else
            return json_encode("success");
    }

    /**
     *发送短信
     * 返回json
     * result : true|false  发送成功或者失败
     * count :  1|2|...     同一会话调用次数，3次以上需要进行短信验证
     * msg:  error  错误描述
     */
    public function actionSend(){
        $array["result"] = false;
        if(Yii::$app->request->post('useraccount')!=null ){
            /* 找回密码时，不验证发送次数*/
            if(Yii::$app->session['__validateCode_count'] > 3 && Yii::$app->request->post('sign') !=='findPassword'){
                $imgcode = Yii::$app->request->post('imageCode');

                $ca = Yii::$app->  createController('site/captcha');
                list($controller, $actionID) = $ca;
                $action = $controller->createAction($actionID);
                $code = $action->getVerifyCode(false);
                if(  $imgcode !== $code ){
                    $array["result"] = false;
                    $array["msg"] = '请填写正确的图形验证码!';
                    return json_encode($array);
                }
            }
            $mobel = Yii::$app->request->post('useraccount');
            $sendSMS = new SendPhoneSMS();
            $array  = $sendSMS ->send_sms_action($mobel,Yii::$app->request->post('sign'));
        }elseif(Yii::$app->request->post('sign')==='findPassword'){
            $session = Yii::$app->getSession();
            $session->open();
            $mobel = $session['userAccount'];
            $sendSMS = new SendPhoneSMS();
            $array  = $sendSMS ->send_sms_action($mobel,Yii::$app->request->post('sign'));
        }
        return json_encode($array);
    }

    /**
     * 找回密码 步骤1 验证用户存在
     * @return string
     */
    public function actionRequestPasswordReset()
    {
        $model = new CusUserAccount();
        $error =null;

        if (  $imgcode = Yii::$app->request->post('verifyCode') ) {
            $ca = Yii::$app->createController('site/captcha');
            list($controller, $actionID) = $ca;
            $action = $controller->createAction($actionID);
            $code = $action->getVerifyCode(false);
            if ($imgcode !== $code) {
                $error = '请填写正确的图形验证码!';
            } elseif ( $useraccount = Yii::$app->request->post('userAccount')) {
                $model = $model->findByUsername($useraccount);
                if ($useraccount === null ||  $model === null ) {
                    $error = '此用户不存在';
                } else {
                    $session = Yii::$app->getSession();
                    $session->set('UserId',$model->id);
                    $session->set('userAccount',$model->userAccount);
                    return $this->render('requestPasswordValidate', [
                        'userAccount' =>  $useraccount,'error'=> null
                ]);
                }
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,'error'=>$error
        ]);
    }

    /**
     * 找回密码 步骤2 验证短信
     * @return string
     */
    public function actionRequestPasswordSms()
    {
        $error =null;
        $session = Yii::$app->getSession();
        $session->open();
        if ($imgcode = Yii::$app->request->post('code')) {
            $validate = new GenerateValidateCode();
            if($session[$validate->name]==null){
                $error = '获取短信动态码有误，请重新获取';
            }elseif($validate->validate($imgcode)==false){
                $error = '手机动态码错误，请重新输入';
            }else{
                return $this->render('resetPassword');
            }
        }
        return $this->render('resetPassword', [
            'userAccount' => $_SESSION['userModel']->userAccount,'error'=>$error
        ]);
    }

    /**
     * 找回密码 步骤3 保存密码
     * @return string
     */
    public function actionResetPassword()
    {
        $erorr = null;
        if ($password = Yii::$app->request->post('userPassWord')) {
            $password_ret = Yii::$app->request->post('password_reset');
            if($password === $password_ret  ){
                $session = Yii::$app->getSession();
                $session->open();
                $userId =  $session['UserId'];
                if($userId === null){
                    $model = new CusUserAccount();
                    $error = '您操作的帐户有异常，请重新再试';
                    return $this->render('requestPasswordResetToken', [
                        'model' => $model,'error'=>$error
                    ]);
                }
                $model = new CusUserAccount();
                $result = $model->updatePassword($password,$userId);
                if($result !== 1){
                    $erorr = '数据更新出现问题，请稍后再试！';
                    return $this->render('resetPassword',['erorr'=>$erorr]);
                }
                return $this->goHome();
            }else{
                $erorr = '两次输入的密码不一致！';
            }
        }
        return $this->render('resetPassword',['erorr'=>$erorr]);
    }
}
