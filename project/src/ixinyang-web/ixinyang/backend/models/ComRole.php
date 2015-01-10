<?php

namespace backend\models;

use Yii;
use yii\validators\UniqueValidator;

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
class ComRole extends \yii\db\ActiveRecord
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
            [['roleName'],'required','message' => '{attribute}不能为空.'],
            [['roleName'],'unique','message' => '{attribute}已存在.'],
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
            'roleCode' => '角色编码',
            'roleName' => '角色',
            'isValid' => '是否有效',
            'updatePerson' => '修改人',
        ];
    }
}
