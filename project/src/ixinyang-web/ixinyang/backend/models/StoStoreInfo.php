<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_store_info".
 *
 * @property integer $id
 * @property string $createTime
 * @property string $storeAddress
 * @property string $storeType
 * @property string $storeName
 * @property string $contactWay
 * @property integer $sellerId
 * @property string $validity
 * @property string $businessHours
 * @property string $longitude
 * @property string $latitude
 * @property string $storeOutline
 * @property integer $businessDistrictId
 * @property integer $cityId
 * @property integer $countryID
 */
class StoStoreInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_store_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime'], 'safe'],
            [['sellerId', 'businessDistrictId', 'cityId', 'countryID','storeType'], 'integer'],
            [['storeOutline'], 'string'],
            [['businessHours','alipayName'], 'string', 'max' => 150],
            [['storeAddress', 'storeName'], 'string', 'max' => 250],
            [['validity'], 'string', 'max' => 2],
            [['contactWay'], 'string', 'max' => 50],
            [['longitude', 'latitude'], 'number'],
            [['alipayNo'], 'string', 'max' => 40],
            [['accountBalance'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '门店ID',
            'createTime' => '创建时间',
            'storeAddress' => '店铺地址',
            'storeType' => '店铺类别',
            'storeName' => '门店名称',
            'contactWay' => '联系方式',
            'sellerId' => '商家ID',
            'validity' => '是否有效',
            'businessHours' => '营业时间',//  如：早上10：00到晚上22：00
            'longitude' => '坐标：经度',
            'latitude' => '坐标：纬度',
            'storeOutline' => '门店概述',
            'businessDistrictId' => '商圈id',
            'cityId' => '城市id',
            'countryID' => '区县id',
        ];
    }
}
