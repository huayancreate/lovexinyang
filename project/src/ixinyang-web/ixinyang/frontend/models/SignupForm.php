<?php
namespace frontend\models;

use frontend\models\CusUserAccount;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $userAccount;
    public $code;
    public $userPassWord;
    public $password_reset;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['userAccount', 'filter', 'filter' => 'trim'],
            ['userAccount', 'required'],
            ['userAccount', 'unique', 'targetClass' => '\frontend\models\CusUserAccount', 'message' => '此手机号码已经注册，请直接登录.'],
            ['userAccount','match','pattern'=>'/^1[0-9]{10}$/','message'=>'{attribute}必须为1开头的手机号'],
            ['code', 'filter', 'filter' => 'trim'],
            ['code', 'required'],

            ['userPassWord', 'filter', 'filter' => 'trim'],
            ['userPassWord', 'required','message'=>'请填写密码'],
            ['password_reset', 'required','message'=>'请再次填写密码'],
            [['userPassWord','password_reset'], 'string', 'min' => 6,'max' => 24],
            ['password_reset','compare','compareAttribute'=>'userPassWord','message'=>'两次密码不一致'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userAccount' => '用户帐号',
            'userPassWord' => '创建密码',
            'code' => '短信动态码',
            'password_reset' => '确认密码',
            'piccode' => '图形验证码'
        ];
    }

    /**
     * Signs user up.
     *
     * @return CusUserAccount|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new CusUserAccount();
            $user->userAccount = $this->userAccount;
            $user->userPassWord = $this->userPassWord;
            $user->registrationDate = date("Y-m-d H:i:s");
            $user->validity = "1";
            $user->setPassword($this->userPassWord);
           // $user->generateAuthKey();
            $user->save();
            return $user;
        }else{
            return null;
        }
    }

}
