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
 * @property double $actualBalanceMoney
 * @property string $financeReviewTime
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
            [['financeId', 'financeReviewStatus', 'reviewId', 'reviewStatus', 'storeId', 'applyerId'], 'integer'],
            [['reviewTime', 'balanceEndTime', 'balanceStartTime', 'financeReviewTime'], 'safe'],
            [['serviceFee', 'applyMoney', 'actualBalanceMoney'], 'number'],
            [['serviceAgreement'], 'string'],
            [['financeAccount', 'reviewAccount', 'storeName', 'applyerAccount'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'financeId' => 'Finance ID',
            'financeAccount' => 'Finance Account',
            'financeReviewStatus' => 'Finance Review Status',
            'reviewId' => 'Review ID',
            'reviewAccount' => 'Review Account',
            'reviewTime' => 'Review Time',
            'reviewStatus' => 'Review Status',
            'serviceFee' => 'Service Fee',
            'serviceAgreement' => 'Service Agreement',
            'balanceEndTime' => 'Balance End Time',
            'balanceStartTime' => 'Balance Start Time',
            'storeId' => 'Store ID',
            'storeName' => 'Store Name',
            'applyerId' => 'Applyer ID',
            'applyerAccount' => 'Applyer Account',
            'applyMoney' => 'Apply Money',
            'actualBalanceMoney' => 'Actual Balance Money',
            'financeReviewTime' => 'Finance Review Time',
        ];
    }
}
