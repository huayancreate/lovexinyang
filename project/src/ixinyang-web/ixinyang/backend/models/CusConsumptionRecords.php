<?php

namespace backend\models;

use Yii;

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
 * @property string $memberName
 * @property integer $sellerId
 * @property string $sellerName
 * @property string $sellerAccount
 * @property string $verifierAccount
 * @property string $verifierTime
 * @property integer $shopId
 * @property string $shopName
 * @property string $flag
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
            'flag' => '消费类型标识',
        ];
    }

  
}
