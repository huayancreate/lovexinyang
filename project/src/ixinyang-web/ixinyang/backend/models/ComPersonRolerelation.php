<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_person_rolerelation".
 *
 * @property integer $id
 * @property string $updateTime
 * @property integer $roleId
 * @property integer $personId
 * @property string $isValid
 * @property integer $accountType
 */
class ComPersonRolerelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_person_rolerelation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['updateTime'], 'safe'],
            [['roleId', 'personId', 'accountType'], 'integer'],
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
            'updateTime' => '更新时间',
            'roleId' => '角色ID',
            'personId' => '账号ID',
            'isValid' => '是否有效',
            'accountType' => '账号类型',
        ];
    }
}
