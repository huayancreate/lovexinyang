<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_county".
 *
 * @property integer $countyId
 * @property string $countyName
 * @property integer $cityCenterId
 * @property string $isValid
 */
class ComCounty extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_county';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityCenterId'], 'integer'],
            [['countyName'], 'string', 'max' => 600],
            [['isValid'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countyId' => '区县ID',
            'countyName' => '区县名称',
            'cityCenterId' => '市区id（扩展备用）',
            'isValid' => '0 无效、1 有效',
        ];
    }
}
