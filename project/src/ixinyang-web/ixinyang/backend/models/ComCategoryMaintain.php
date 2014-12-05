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
            'parentCategoryId' => 'Parent Category ID',
            'categoryAttribute' => 'Category Attribute',
            'categoryFeature' => 'Category Feature',
            'categoryCode' => 'Category Code',
            'categoryGrade' => 'Category Grade',
            'categoryName' => 'Category Name',
            'categoryType' => 'Category Type',
            'operatorId' => 'Operator ID',
            'operatorName' => 'Operator Name',
            'updateTime' => 'Update Time',
            'isValid' => 'Is Valid',
            'sort' => 'Sort',
        ];
    }
}
