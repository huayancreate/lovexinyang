<?php

namespace backend\models;

use Yii;

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
            [['flag'], 'integer'],
            [['username', 'password_repeat', 'verifyCode', 'nickName'], 'string', 'max' => 50],
            [['password'], 'string', 'max' => 150],
            [['userphoto'], 'string', 'max' => 100],
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
            'username' => 'Username',
            'password' => 'Password',
            'password_repeat' => 'Password Repeat',
            'verifyCode' => 'Verify Code',
            'userphoto' => 'Userphoto',
            'nickName' => 'Nick Name',
            'validity' => 'Validity',
            'flag' => 'Flag',
        ];
    }
}
