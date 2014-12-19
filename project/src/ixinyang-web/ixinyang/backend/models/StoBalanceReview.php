<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_balance_review".
 *
 * @property integer $id
 * @property integer $financeId
 * @property string $financeAccount
 * @property integer $financeReviewStatus
 * @property integer $reviewId
 * @property string $reviewAccount
 * @property string $reviewTime
 * @property integer $reviewStatus
 * @property double $serviceFee
 * @property resource $serviceAgreement
 * @property string $balanceEndTime
 * @property string $balanceStartTime
 * @property integer $storeId
 * @property string $storeName
 * @property integer $applyerId
 * @property string $applyerAccount
 * @property double $applyMoney
 */
class StoBalanceReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_balance_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['financeId', 'financeReviewStatus', 'reviewId', 'reviewStatus', 'storeId', 'applyerId','shopId'], 'integer'],
            [['reviewTime', 'balanceEndTime', 'balanceStartTime', 'applyTime', 'financeReviewTime'], 'safe'],
            [['serviceFee', 'applyMoney', 'actualBalanceMoney'], 'number'],
            [['serviceAgreement'], 'string'],
            [['financeAccount', 'reviewAccount', 'storeName', 'applyerAccount'], 'string', 'max' => 50],
            [['shopName'],'string', 'max' => 100],
            [['remark'],'string','max'=>200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'financeId' => '财务人员Id',
            'financeAccount' => '财务人员账号',
            'financeReviewStatus' => '财务审核状态',
            'reviewId' => '初审人员Id',
            'reviewAccount' => '初审人员账号',
            'reviewTime' => '初审时间',
            'reviewStatus' => '初审状态',
            'serviceFee' => '服务费抽取金额',
            'serviceAgreement' => '服务费协议',
            'balanceEndTime' => '结算截止时间',
            'balanceStartTime' => '结算起始时间',
            'storeId' => '商家Id',
            'storeName' => '商家名称',
            'shopId'=>'店铺id',
            'shopName'=>'店铺名称',
            'applyerId' => '申请人Id',
            'applyerAccount' => '申请人账号',
            'applyMoney' => '申请总金额',
            'applyTime' => '申请时间',
            'actualBalanceMoney' => '实际结算金额',
            'financeReviewTime' => '财务审核时间',
            'remark'=>'备注',
        ];
    }
}
