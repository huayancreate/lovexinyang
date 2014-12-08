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
            //去掉前后空格
            [['menuName','menuUrl'],'trim'],
            //菜单名称不能为空
            [['menuName','menuUrl'],'required','message'=>'{attribute}不能为空'],
             //检查菜单名是否重复
            ['menuUrl','unique','message'=>'{attribute}已经存在'],
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
            'menuUrl' => '菜单路径',
            'menuName' => '菜单名称',
            'createTime' => '创建时间',
            'parentMenuId' => '父菜单',
            'updateTime' => '修改时间',
            'isValid' => '是否有效',
        ];
    }
}
