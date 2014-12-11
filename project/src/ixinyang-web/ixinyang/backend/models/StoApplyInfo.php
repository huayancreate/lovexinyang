<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_apply_info".
 *
 * @property integer $applyId
 * @property string $city
 * @property double $longitude
 * @property double $latitude
 * @property string $scopeBusiness
 * @property integer $customerServiceId
 * @property string $customerServiceName
 * @property string $cusServiceReviewTime
 * @property integer $customerManagerId
 * @property string $customerManagerName
 * @property string $cusManagerReviewTime
 * @property string $storePhone
 * @property string $storeName
 * @property string $otherContact
 * @property string $regional
 * @property double $daySales
 * @property integer $storeApplyNumber
 * @property string $businessZone
 * @property string $applyTime
 * @property string $phone
 * @property string $address
 * @property string $name
 * @property string $email
 * @property integer $applyStatus
 * @property integer $storeCategoryId
 */
class StoApplyInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_apply_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['city','storeName','regional', 'businessZone','storePhone','phone','storeCategoryId','address', 'name'],'required','message' => '{attribute}不能为空.'],
            [['city','storeName', 'otherContact', 'regional', 'businessZone', 'email','storePhone','phone','scopeBusiness','address', 'name'],'trim'],
            [['email'],'email','message'=>'邮箱格式错误.'],

            [['longitude', 'latitude', 'daySales'], 'number'],
            [['customerServiceId', 'customerManagerId','storeApplyNumber', 'applyStatus', 'storeCategoryId','city','regional', 'businessZone'], 'integer'],
            [['cusServiceReviewTime', 'cusManagerReviewTime', 'applyTime'], 'safe'],
            [['customerServiceName', 'customerManagerName','otherContact',  'email','storePhone','phone'], 'string', 'max' => 50],
            [['scopeBusiness'], 'string'],
            [['address', 'name','storeName'], 'string', 'max' => 250]
        ];
//        return [
//            [['longitude', 'latitude', 'daySales'], 'number'],
//            [['customerServiceId', 'customerManagerId', 'storeApplyNumber', 'applyStatus', 'storeCategoryId'], 'integer'],
//            [['cusServiceReviewTime', 'cusManagerReviewTime', 'applyTime'], 'safe'],
//            [['city', 'customerServiceName', 'customerManagerName', 'storePhone', 'otherContact', 'regional', 'businessZone', 'phone', 'email'], 'string', 'max' => 50],
//            [['scopeBusiness'], 'string', 'max' => 200],
//            [['storeName', 'address', 'name'], 'string', 'max' => 250]
//        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'applyId' => 'ID',
            'city' => '城市',
            'longitude' => '经度',
            'latitude' => '纬度',
            'scopeBusiness' => '经营内容',
            'customerServiceId' => '客服ID',
            'customerServiceName' => '客服姓名',
            'cusServiceReviewTime' => '客服审核时间',
            'customerManagerId' => '客户经理ID',
            'customerManagerName' => '客户经理姓名',
            'cusManagerReviewTime' => '客户经理审核时间',
            'storePhone' => '门店电话',
            'storeName' => '门店名称',
            'otherContact' => '其他联系方式',
            'regional' => '区域',
            'daySales' => '日销售额',
            'storeApplyNumber' => '商家申请编号',
            'businessZone' => '商圈',
            'applyTime' => '申请时间',
            'phone' => '手机号码',
            'address' => '详细地址',
            'name' => '商家姓名',
            'email' => '邮箱',
            'applyStatus' => '审核状态',
            'storeCategoryId' => '商家类型',
        ];
    }
}
