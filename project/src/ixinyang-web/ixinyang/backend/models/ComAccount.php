<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_account".
 *
 * @property integer $id
 * @property string $email
 * @property string $createTime
 * @property string $phoneNumber
 * @property string $updateTime
 * @property string $password
 * @property string $sex
 * @property string $nickname
 * @property string $userName
 * @property integer $accountStatus
 * @property string $address
 */
class ComAccount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userName','email', 'nickname','address','phoneNumber'],'trim'],
            [['userName','email', 'nickname','address','phoneNumber'],'required','message' => '{attribute}不能为空.'],
            [['email'],'email','message'=>'邮箱格式错误.'],
            ['userName','unique','message'=>'账号已被使用.'],

            [['createTime', 'updateTime'], 'safe'],
            [['accountStatus'], 'integer'],
            [['email', 'nickname', 'userName'], 'string', 'max' => 50],
            [['phoneNumber', 'password'], 'string', 'max' => 20],
            [['sex'], 'string', 'max' => 4],
            [['address'], 'string', 'max' => 200],
            [['isFirstLogin'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => '邮箱',
            'createTime' => '创建时间',
            'phoneNumber' => '电话',
            'updateTime' => '更新时间',
            'password' => '密码',
            'sex' =>'性别',
            'nickname' => '姓名',
            'userName' => '账号',
            'accountStatus' => '状态',
            'address' => '住址',
            'isFirstLogin'=>'首次登录',
        ];
    }
}
