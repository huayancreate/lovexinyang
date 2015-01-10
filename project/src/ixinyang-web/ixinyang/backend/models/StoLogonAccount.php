<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_logon_account".
 *
 * @property integer $id
 * @property integer $storeId
 * @property integer $roleId
 * @property integer $sellerId
 * @property string $password
 * @property string $loginName
 * @property string $nickName
 * @property string $validity
 * @property integer $flag
 */
class StoLogonAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_logon_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['storeId', 'roleId', 'sellerId', 'flag'], 'integer'],
            [['password', 'loginName', 'nickName'], 'string', 'max' => 50],
            [['validity'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'storeId' => 'Store ID',
            'roleId' => 'Role ID',
            'sellerId' => 'Seller ID',
            'password' => 'Password',
            'loginName' => 'Login Name',
            'nickName' => 'Nick Name',
            'validity' => 'Validity',
            'flag' => 'Flag',
        ];
    }

    /**
     *根据商家登录名获取商家登录信息
     * @param string $loginname          
     * @return static null
     */
    public static function findByUsername($loginname)
    {
        return static::findOne([
            'loginName' => $loginname,
            //'status' => self::STATUS_ACTIVE 
        ]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
