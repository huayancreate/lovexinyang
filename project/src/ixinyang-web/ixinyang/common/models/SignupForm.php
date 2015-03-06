<?php
namespace common\models;

use yii\base\Model;
use common\models\User;
use Yii;


/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    //public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message'=>'账号不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '此账号已被占用.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

//            ['email', 'filter', 'filter' => 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required','message'=>'密码不能为空'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            return User::create($this->attributes);
        }
        return null;
    }
}
