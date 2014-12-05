<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_business_district".
 *
 * @property integer $countyId
 * @property integer $businessDistrictId
 * @property integer $businessDistrictCode
 * @property string $businessDistrictName
 * @property string $isValid
 */
class ComBusinessDistrict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_business_district';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
              //去掉前后空格
            [['businessDistrictCode','businessDistrictName'],'trim'],
            //商圈编码、商圈名称不能为空
            [['businessDistrictCode','businessDistrictName'],'required','message'=>'{attribute}不能为空'],
             //商圈编码、商圈名称是否重复
            [['businessDistrictCode','businessDistrictName'],'unique','message'=>'{attribute}已经存在'],
            [['countyId', 'businessDistrictCode'], 'integer'],
            [['businessDistrictName'], 'string', 'max' => 200],
            [['isValid'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countyId' => '区县名称',
            'businessDistrictId' => '商圈ID',
            'businessDistrictCode' => '商圈编码',
            'businessDistrictName' => '商圈名称',
            'isValid' => '是否有效',
        ];
    }
}
