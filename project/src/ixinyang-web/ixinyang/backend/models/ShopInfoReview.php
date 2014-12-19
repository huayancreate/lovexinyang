<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop_info_review".
 *
 * @property integer $id
 * @property string $city
 * @property double $longitude
 * @property double $latitude
 * @property string $shopName
 * @property string $contact
 * @property string $regional
 * @property integer $storeId
 * @property string $storeAccount
 * @property integer $businessDistrictId
 * @property string $address
 * @property string $businessHours
 * @property string $storeOutline
 * @property integer $cityId
 * @property integer $countyId
 * @property string $applyTime
 * @property integer $applyUserId
 * @property string $applyUserName
 * @property integer $auditUserId
 * @property string $auditUserName
 * @property integer $auditTime
 * @property integer $managerId
 * @property string $managerName
 * @property integer $managerTime
 * @property integer $auditState
 * @property string $Rejection
 */
class ShopInfoReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_info_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['longitude', 'latitude'], 'number'],
            [['storeId', 'businessDistrictId', 'cityId', 'countyId', 'applyUserId', 'auditUserId', 'managerId', 'auditState','shopId','storeType'], 'integer'],
            [['storeOutline'], 'string'],
            [['applyTime', 'auditTime', 'managerTime'], 'safe'],
            [['city', 'shopName', 'contact', 'regional', 'storeAccount'], 'string', 'max' => 50],
            [['address'], 'string', 'max' => 250],
            [['businessHours', 'applyUserName', 'auditUserName', 'managerName', 'Rejection'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city' => '城市',
            'longitude' => '地图经度',
            'latitude' => '地图纬度',
            'shopName' => '店铺名称',
            'contact' => '联系方式',
            'regional' => '区域',
            'storeId' => '商家ID',
            'storeAccount' => '商家账号',
            'businessDistrictId' => '商圈',
            'address' => '详细地址',
            'businessHours' => '营业时间',
            'storeOutline' => '门店概述',
            'cityId' => '地市',
            'countyId' => '区县',
            'applyTime' => '申请时间',
            'applyUserId' => '申请人ID',
            'applyUserName' => '申请人姓名',
            'auditUserId' => '初审人ID',
            'auditUserName' => '初审人姓名',
            'auditTime' => '初审时间',
            'managerId' => '客户经理ID',
            'managerName' => '客户经理姓名',
            'managerTime' => '客户经理审核时间',
            'auditState' => '审核状态', //1、申请中 2、初审通过 3、初审驳回 4、经理审核通过  5、经理审核驳回
            'Rejection' => '驳回原因',
        ];
    }

    public function getState($index){
        switch ($index) {
            case '1':
                return "申请中";
                break;
            case '2':
                return "初审通过";
                break;
            case '3':
                return "初审驳回";
                break;
            case '4':
                return "经理审核通过";
                break;
            case '5':
                return "经理审核驳回";
                break;
        }
    }
}
