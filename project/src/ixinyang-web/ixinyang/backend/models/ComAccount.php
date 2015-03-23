<?php

namespace backend\models;

use Yii;
use yii\base\Exception;

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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
       
        $scenarios['update'] = ['userName', 'email', 'nickname', 'address', 'phoneNumber','sex','createTime', 'updateTime'];
       
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'nickname', 'address', 'phoneNumber'], 'trim'],
            [['email', 'nickname', 'address', 'phoneNumber'], 'required', 'message' => '{attribute}不能为空.','on'=>'update'],
            [['email'], 'email', 'message' => '邮箱格式错误.'],
            ['userName', 'unique', 'message' => '账号已被使用.'],
            [['createTime', 'updateTime'], 'safe'],
            [['accountStatus'], 'integer'],
            [['email', 'nickname', 'userName'], 'string', 'max' => 50],
            [['phoneNumber', 'password'], 'string', 'max' => 20],
            [['sex'], 'string', 'max' => 4],
            [['address'], 'string', 'max' => 200],
            [['isFirstLogin'], 'string', 'max' => 4],
            [['phoneNumber'], 'match', 'pattern' => '/^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/', 'message' => '手机号码格式不正确','on'=>'update'],
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
            'phoneNumber' => '手机号码',
            'updateTime' => '更新时间',
            'password' => '密码',
            'sex' => '性别',
            'nickname' => '姓名',
            'userName' => '账号',
            'accountStatus' => '状态',
            'address' => '住址',
            'isFirstLogin' => '首次登录',
        ];
    }

    //保存用户账号与用户角色关联表
    public function saveUserAccount($roleIdArr)
    {
        //事务开始
        $transaction = $this->getDb()->beginTransaction();
        try {
            //1.保存用户数据
            $this->saveAccount();
            //2.保存用户与角色关系表
            $this->saveRelation($roleIdArr);
            //3.提交
            $transaction->commit();

        } catch (Exception  $e) {
            $transaction->rollBack();
        }

    }

    //删除用户账号
    public function deleteAccount($id)
    {
        $transaction = $this->getDb()->beginTransaction();
        try {
            //1.更新用户状态
            $this->accountStatus = "0";
            $this->save();
            //2.删除用户角色关联表
            $this->DeleteRelation($id);
            //3.提交
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }

    }

    //更新用户账号
    public function updateAccount($roleIdArr)
    {
        //事务开始
        $transaction = $this->getDb()->beginTransaction();
        try {
            //1.更新用户表
            $this->update();
            //2.删除关联后重新添加关系
            $relationAttr = ComPersonRolerelation::find()->where(["personId" => $this->id])->all();
            foreach ($relationAttr as $relation) {
                $relation->delete();
            }
            $this->SaveRelation($roleIdArr);

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }

    }

    //保存用户与角色关系
    public function saveRelation($roleIdArr)
    {
        if ($this->id != null) {
            foreach ($roleIdArr as $roleId) {
                $roleRelation = new ComPersonRolerelation();
                $roleRelation->roleId = $roleId;
                $roleRelation->personId = $this->id;
                $roleRelation->isValid = "1";
                $roleRelation->updateTime = date("Y-m-d H:i:s");
                $roleRelation->accountType = "1";
                $roleRelation->save();
            }
        }
    }

    //保存用户账号
    public function saveAccount()
    {
        $this->createTime = date("Y-m-d H:i:s");
        $this->updateTime = date("Y-m-d H:i:s");
        $this->password = '123456';
        $this->isFirstLogin = '1';
        $this->accountStatus = 1;
        $this->save();
    }

    //删除用户账号与角色关联
    public function deleteRelation($id)
    {
        $relationArr = ComPersonRolerelation::find()->where(['personId' => $id])->all();
        foreach ($relationArr as $relation) {
            $relation->delete();
        }
    }

    //获取用户拥有的所有角色Id
    public function getAllRoleId($id)
    {
        $relationArr = ComPersonRolerelation::find()->where(['personId' => $id])->all();
        $roleId = "";
        foreach ($relationArr as $relation) {
            $roleId = $roleId . $relation->roleId . ',';
        }
        $roleId = substr($roleId, 0, -1);
        return $roleId;
    }

    //获取所有角色
    public function getAllRole()
    {
       // return ComRole::find()->where(["isValid" => '1'])->all();
       return AuthItem::find()->where(["type" => 1])->all();
    }
}
