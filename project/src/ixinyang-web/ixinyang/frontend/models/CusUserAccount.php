<?php

namespace frontend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "cus_user_account".
 *
 * @property integer $id
 * @property string $validity
 * @property string $userPassWord
 * @property string $applyPassword
 * @property string $userAccount
 * @property string $registrationDate
 */
class CusUserAccount extends \yii\db\ActiveRecord  implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_USER = 10;

    public $password_reset_token;
    public $password_hash;

    public $verifyCode;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_user_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [];
//        return [
//            [['registrationDate'], 'safe'],
//            [['validity'], 'string', 'max' => 2],
//            [['userPassWord', 'applyPassword', 'userAccount'], 'string', 'max' => 150]
//        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'validity' => 'Validity',
            'userPassWord' => '密码',
            'applyPassword' => '支付密码',
            'userAccount' => '用户帐号',
            'registrationDate' => 'Registration Date',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'validity' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['userAccount' => $username, 'validity' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'validity' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;// 待修改
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->userPassWord);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->userPassWord = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function updatePassword($password,$id)
    {
        $this->userPassWord = Yii::$app->security->generatePasswordHash($password);
        return $this->updateBySql('cus_user_account',['userPassWord'=>$this->userPassWord ], ['id' =>$id]);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
