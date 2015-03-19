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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['update'] = ['storeName','storeType','storeAddress','contactWay','businessHours','longitude', 'latitude'];
        
        return $scenarios;
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
            [['accountBalance'], 'number'],
            [['storeName','storeType','storeAddress','contactWay','businessHours','longitude', 'latitude'],'required','message'=>'{attribute}不能为空','on'=>'update'],
            [['contactWay'], 'match', 'pattern' => '/^((0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/', 'message' => '门店电话格式不正确，正确格式为0551-12345678','on'=>'update'],
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

    public function getStoreInfoByStoreId($id)
    {
        if (($model=StoStoreInfo::find()->where("id=".$id)->one())!==null) {
            return $model;
        }  
        else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
}
