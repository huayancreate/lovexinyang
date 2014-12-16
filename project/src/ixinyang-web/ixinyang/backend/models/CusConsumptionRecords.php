<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "cus_consumption_records".
 *
 * @property integer $id
 * @property string $orderNo
 * @property integer $orderId
 * @property integer $goodsId
 * @property string $verfificationCode
 * @property integer $goodsNumber
 * @property double $costPrice
 * @property double $payablePrice
 * @property string $rebate
 * @property string $userAccount
 * @property string $memberCardNo
 * @property integer $sellerId
 * @property string $sellerAccount
 * @property string $verifierAccount
 * @property string $verifierTime
 */
class CusConsumptionRecords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_consumption_records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'goodsId', 'goodsNumber', 'sellerId'], 'integer'],
            [['costPrice', 'payablePrice'], 'number'],
            [['verifierTime'], 'safe'],
            [['orderNo', 'verfificationCode', 'rebate', 'userAccount', 'memberCardNo', 'sellerAccount', 'verifierAccount'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderNo' => 'Order No',
            'orderId' => 'Order ID',
            'goodsId' => 'Goods ID',
            'verfificationCode' => 'Verfification Code',
            'goodsNumber' => 'Goods Number',
            'costPrice' => 'Cost Price',
            'payablePrice' => 'Payable Price',
            'rebate' => 'Rebate',
            'userAccount' => 'User Account',
            'memberCardNo' => 'Member Card No',
            'sellerId' => 'Seller ID',
            'sellerAccount' => 'Seller Account',
            'verifierAccount' => 'Verifier Account',
            'verifierTime' => 'Verifier Time',
        ];
    }

    public function settleAccount($fromDate, $toDate)
    {
        //1.根据时间段去查询当前时间段中商家的所有消费流水(除去线下交易流水)
        $model = $this->getConsumption($fromDate, $toDate);
        //2.产生结账审核记录
        $this->addBalanceReview($fromDate, $toDate, $model->payablePrice);

    }

    public function getConsumption($fromDate, $toDate)
    {
        $sql = "select sum(payablePrice*goodsNumber) as payablePrice from cus_consumption_records
              where sellerId=1 and (verifierTime BETWEEN '$fromDate' and '$toDate')";
        $model = CusConsumptionRecords::findBySql($sql)->one();
        return $model;
    }

    public function addBalanceReview($fromDate, $toDate, $totalMoney)
    {
        $model = new StoBalanceReview();
        $model->financeId = 0;
        $model->financeAccount = "201412141154";
        $model->financeReviewStatus = 0;
        $model->reviewId = 0;
        $model->reviewAccount = "0";
        $model->reviewTime = 0;
        $model->reviewStatus = 0;
        $model->serviceFee = 0;
        $model->serviceAgreement = "0";
        $model->balanceStartTime = $fromDate;
        $model->balanceEndTime = $toDate;
        $model->storeId = 0;
        $model->storeName = "测试数据";
        $model->applyerId = 0;
        $model->applyerAccount = "201412141153";
        $model->applyMoney = $totalMoney;
        $model->actualBalanceMoney = 0;
        $model->financeReviewTime = 0;

        $model->save();
    }

}
