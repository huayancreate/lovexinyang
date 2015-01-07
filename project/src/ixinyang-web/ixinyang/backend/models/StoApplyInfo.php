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
            //去掉前后空格
            [['city', 'storeName', 'regional', 'businessZone', 'storePhone', 'phone', 'address', 'name'], 'required', 'message' => '{attribute}不能为空.'],
            [['remark'], 'trim'],
            [['longitude', 'latitude', 'daySales'], 'number'],
            [['email'], 'email'],
            [['storePhone'], 'match', 'pattern' => '/^((0\d{2,3})-)?(\d{7,8})(-(\d{3,}))?$/', 'message' => '门店电话格式不正确，正确格式为0551-12345678'],
            [['phone'], 'match', 'pattern' => '/^0?(13[0-9]|15[012356789]|18[0236789]|14[57])[0-9]{8}$/', 'message' => '手机号码格式不正确'],
            [['customerServiceId', 'customerManagerId', 'storeApplyNumber', 'applyStatus', 'city', 'regional', 'businessZone'], 'integer'],
            [['cusServiceReviewTime', 'cusManagerReviewTime', 'applyTime'], 'safe'],
            [['customerServiceName', 'customerManagerName', 'storePhone', 'otherContact', 'phone', 'email'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 200],
            [['scopeBusiness'], 'string'],
            [['storeName', 'address', 'name'], 'string', 'max' => 250],
            [['businessHours'], 'string', 'max' => 150]
        ];
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
            'remark' => '驳回备注',
        ];
    }


    /* //根据申请状态和申请时间查询待审核的信息 参数 applyStatus->0 时说明角色是我们平台客服中心查询
     //applyStatus->1时 说明是我们平台客户经理查询的
     public function selectByApplyTimeAndApplyStatus($applyStatus,$fromDate,$toDate)
     {

        $query=StoApplyInfo::find()->where('applyStatus="'.$applyStatus.'" and applyTime between "'.$fromDate.'" and "'.$toDate.'"')->asArray();
     }*/
}
