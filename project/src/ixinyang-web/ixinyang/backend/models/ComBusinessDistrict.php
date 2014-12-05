<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_business_district".
 *
 * @property integer $businessDistrictId
 * @property integer $businessDistrictCode
 * @property string $businessDistrictName
 * @property integer $countyId
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
            [['businessDistrictCode', 'countyId'], 'integer'],
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
            'businessDistrictId' => '商圈ID',
            'businessDistrictCode' => '商圈编码',
            'businessDistrictName' => '商圈名称',
            'countyId' => '区县id',
            'isValid' => '0 无效、1 有效',
        ];
    }
}
