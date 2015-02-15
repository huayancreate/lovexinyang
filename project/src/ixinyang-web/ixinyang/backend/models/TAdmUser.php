<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "t_adm_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property string $role
 * @property string $status
 * @property integer $flag
 * @property integer $created_at
 * @property integer $updated_at
 */
class TAdmUser extends \yii\db\ActiveRecord
{
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
            [['username','password_hash'], 'required','message' => '{attribute}不能为空.'],
            [['flag', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_reset_token', 'email', 'role'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 150],
            [['auth_key'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '账号',
            'password_hash' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'role' => '账号名称、昵称',
            'status' => '是否有效',
            'flag' => '权限标识：0、对应商家下所有分店 1、分店',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'sellerId'=>'商家id',
            'storeId'=>'店铺id',
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord || $this->password_hash!=$this->oldAttributes['password_hash'])
            $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
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
        return Yii::$app->security->validatePassword($password,$this->password_hash);
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
