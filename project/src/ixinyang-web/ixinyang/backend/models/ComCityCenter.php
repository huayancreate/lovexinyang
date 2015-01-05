<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_cityCenter".
 *
 * @property integer $id
 * @property string $cityCenterName
 */
class ComCityCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_cityCenter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityCenterName'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键id',
            'cityCenterName' => '市区名称',
        ];
    }


    /**
     * 获取所有的城市
     */
    public function getAllCity()
    {
        return ComCityCenter::find()->all();
    }

    /**
     * 根据城市Id获取城市下面的所有区县
     * @param $cityId
     */
    public function getCountyByCityId($cityId)
    {
        return ComCounty::find()->where(['cityCenterId' => $cityId, 'isValid' => '1'])->asArray()->all();
    }
}
