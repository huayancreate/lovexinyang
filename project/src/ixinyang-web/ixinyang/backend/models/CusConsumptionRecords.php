<?php

namespace backend\models;

use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use backend\models\StoStoreInfo;

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
            [['orderId', 'goodsId', 'goodsNumber', 'sellerId', 'shopId'], 'integer'],
            [['costPrice', 'payablePrice', 'rebate'], 'number'],
            [['verifierTime'], 'required'],
            [['verifierTime'], 'safe'],
            [['orderNo', 'verfificationCode', 'userAccount', 'memberCardNo', 'memberName', 'sellerAccount', 'verifierAccount'], 'string', 'max' => 50],
            [['sellerName', 'shopName'], 'string', 'max' => 150],
            [['flag'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增列',
            'orderNo' => '订单编号',
            'orderId' => '订单ID',
            'goodsId' => '商品ID',
            'verfificationCode' => '验证码',
            'goodsNumber' => '商品数量',
            'costPrice' => '原价',
            'payablePrice' => '实付价格',
            'rebate' => '折扣',
            'userAccount' => '用户账户',
            'memberCardNo' => '会员卡卡号',
            'memberName' => '会员等级名称',
            'sellerId' => '商家ID',
            'sellerName' => '商家名称',
            'sellerAccount' => '商家账号',
            'verifierAccount' => '验证人账号',
            'verifierTime' => '验证时间',
            'shopId' => '店铺ID',
            'shopName' => '店铺名称',
            'flag' => '消费类型标识', //0 平台消费  1 现金消费
        ];
    }

    public function settleAccount($fromDate, $toDate)
    {
        //1.根据时间段去查询当前时间段中商家的所有消费流水(除去线下交易流水)
        $model = $this->getSumConsumption($fromDate, $toDate);
        //2.产生结账审核记录
        $this->addBalanceReview($fromDate, $toDate, $model->payablePrice);
    }

    public function getSumConsumption($fromDate, $toDate)
    {
        $shopId=1;
        $sql = "select sum(payablePrice*goodsNumber) as payablePrice,sellerName,sellerAccount from cus_consumption_records
              where shopId=$shopId and (verifierTime BETWEEN '$fromDate' and '$toDate') and flag='0'";
        $model = CusConsumptionRecords::findBySql($sql)->one();
        return $model;
    }

    /**
     * @param $fromDate
     * @param $toDate
     * @return ActiveDataProvider
     */
    public function getConsumption($fromDate, $toDate)
    {
        $query = $this::find();
        $id = 1;//商家Id
        $query->andWhere(['shopId' => $id, 'flag' => '0']);
        $query->andFilterWhere(['BETWEEN', 'verifierTime', $fromDate, $toDate]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
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
        $model->shopId = 0;
        $model->shopName = "测试数据";
        $model->applyerId = 0;
        $model->applyTime = date("Y-m-d H:i:s");
        $model->applyerAccount = "201412141153";
        $model->applyMoney = $totalMoney;
        $model->actualBalanceMoney = 0;
        $model->financeReviewTime = 0;
        $model->remark = "";

         //根据店铺id查询  当前店铺的支付宝名称  以及 支付宝账号
        $storeId=1;
        $storeInfoModel= StoStoreInfo::getStoreInfoByStoreId($storeId);
        //支付宝帐号
        $model->alipayNo=$storeInfoModel->alipayNo;
        //支付宝名称
        $model->alipayName=$storeInfoModel->alipayName;

        $model->save();
    }

}
