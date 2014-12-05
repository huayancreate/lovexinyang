<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_category_maintain".
 *
 * @property integer $id
 * @property integer $parentCategoryId
 * @property string $categoryAttribute
 * @property string $categoryFeature
 * @property integer $categoryCode
 * @property integer $categoryGrade
 * @property string $categoryName
 * @property integer $categoryType
 * @property integer $operatorId
 * @property string $operatorName
 * @property string $updateTime
 * @property string $isValid
 * @property integer $sort
 */
class ComCategoryMaintain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_category_maintain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parentCategoryId', 'categoryCode', 'categoryGrade', 'categoryType', 'operatorId', 'sort'], 'integer'],
            [['updateTime'], 'safe'],
            [['categoryAttribute', 'categoryFeature', 'categoryName'], 'string', 'max' => 200],
            [['operatorName'], 'string', 'max' => 50],
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
            'parentCategoryId' => '父类别',
            'categoryAttribute' => '类别属性',
            'categoryFeature' => '类别特性',
            'categoryCode' => '类别编码',
            'categoryGrade' => '类别等级',
            'categoryName' => '类别名称',
            'categoryType' => '类别类型',
            'operatorId' => '操作员Id',
            'operatorName' => '操作员名称',
            'updateTime' => '更新时间',
            'isValid' => '状态',
            'sort' => '排序',
        ];
    }
}
