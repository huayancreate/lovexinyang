<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_role".
 *
 * @property integer $id
 * @property string $creater
 * @property string $updateTime
 * @property integer $roleCode
 * @property string $roleName
 * @property string $isValid
 * @property string $updatePerson
 */
class com_role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //校验是否为空
            [['roleName','roleCode'], 'required','message' => '{attribute}不可为空.'],
            //校验是否重复
            [['roleName', 'roleCode'], 'unique','message' => '{attribute}已存在.'],
            //剔除前后空格
            [['roleName', 'roleCode'], 'trim'],
            [['updateTime'], 'safe'],
            [['roleCode'], 'integer'],
            [['creater', 'roleName', 'updatePerson'], 'string', 'max' => 50],
            [['isValid'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creater' => '创建人',
            'updateTime' => '更新时间',
            'roleCode' => '角色编号',
            'roleName' => '角色名称',
            'isValid' => '是否有效',
            'updatePerson' => 'updatePerson',
        ];
    }
}
