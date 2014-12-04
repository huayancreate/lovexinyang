<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_menu".
 *
 * @property integer $id
 * @property string $menuUrl
 * @property string $menuName
 * @property string $createTime
 * @property integer $parentMenuId
 * @property string $updateTime
 * @property string $isValid
 */
class ComMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'updateTime'], 'safe'],
            [['parentMenuId'], 'integer'],
            [['menuUrl'], 'string', 'max' => 200],
            [['menuName'], 'string', 'max' => 50],
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
            'menuUrl' => 'Menu Url',
            'menuName' => 'Menu Name',
            'createTime' => 'Create Time',
            'parentMenuId' => 'Parent Menu ID',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
        ];
    }
}
