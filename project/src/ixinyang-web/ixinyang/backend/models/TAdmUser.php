<?php

namespace backend\models;

use Yii;

use yii\web\IdentityInterface;


/**
 * This is the model class for table "t_adm_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_repeat
 * @property string $verifyCode
 * @property string $userphoto
 * @property string $nickName
 * @property string $validity
 * @property integer $flag
 */

class TAdmUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password_repeat;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_adm_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['flag'], 'integer'],
            [['verifyCode', 'nickName'], 'string', 'max' => 50],
            [['validity'], 'string', 'max' => 2],
            ['username','unique'],
            [['username', 'password'], 'required'],
            [['password_repeat'],'required','on'=>['create','chgpwd']],
            ['verifyCode','captcha','on'=>['create','chgpwd']],
            [['username', 'password', 'userphoto'], 'string', 'max' => 255],
            ['password_repeat','compare','compareAttribute'=>'password']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password' => '密码',
            'password_repeat'=>'重复密码',
            'verifyCode'=>'验证码',
            'userphoto'=>'用户头像',
            'nickName' => '用户昵称',
            'validity' => '是否有效',
            'flag' => '标识',
        ];
    }

            
        
    
    public function beforeSave($insert)
    {
        if($this->isNewRecord || $this->password!=$this->oldAttributes['password'])
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        return true;
    }

    /**
     * 关联获取角色
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(AuthAssignment::className(),['user_id'=>'id']);
    }

    public static function findByusername($username)
    {
        return static::find()->where('username=:u',[':u'=>$username])->one();
    }

    public  function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password);
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return md5($this->id);
    }
    public function validateAuthKey($authKey)
    {
        return $authKey===$this->getAuthKey();
    }
}

