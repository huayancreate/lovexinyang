<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "com_dictionary".
 *
 * @property integer $id
 * @property string $category
 * @property string $categoryName
 * @property string $code
 * @property string $codeName
 * @property string $parentId
 * @property string $isValid
 */
class ComDictionary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_dictionary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category', 'code', 'parentId'], 'string', 'max' => 50],
            [['categoryName'], 'string', 'max' => 100],
            [['codeName'], 'string', 'max' => 150],
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
            'category' => '字典类别',
            'categoryName' => '字段名称',
            'code' => '分类编码',
            'codeName' => '分类内容',
            'parentId' => '上级编码id',
            'isValid' => '是否有效',
        ];
    }

    public function selectByCategory($category)
    {
        $dictionaryList=ComDictionary::find()->where(['category'=>$category])->all();
        return $dictionaryList;
    }

    public function selectCodeNameById($id)
    {
        $model=ComDictionary::find()->where(['id' => $id])->one();
        return $model;
    }
}
