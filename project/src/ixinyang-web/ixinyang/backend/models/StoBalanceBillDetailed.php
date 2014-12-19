<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_balance_bill_detailed".
 *
 * @property integer $id
 * @property integer $balanceApplyId
 * @property integer $goodsId
 * @property integer $goodsNumber
 * @property integer $consumeSaleStream
 * @property double $payablePrice
 * @property double $costPrice
 * @property string $verificationCode
 * @property string $verificaterAccount
 * @property string $verificateTime
 * @property string $membershipCardNumber
 * @property string $userAccount
 * @property double $userDiscount
 * @property integer $orderId
 * @property integer $shopId
 * @property string $shopName
 * @property integer $sellerId
 * @property string $sellerName
 */
class StoBalanceBillDetailed extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_balance_bill_detailed';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balanceApplyId', 'goodsId', 'goodsNumber', 'consumeSaleStream', 'orderId', 'shopId', 'sellerId'], 'integer'],
            [['payablePrice', 'costPrice', 'userDiscount'], 'number'],
            [['verificateTime'], 'safe'],
            [['verificationCode', 'verificaterAccount', 'membershipCardNumber', 'userAccount'], 'string', 'max' => 50],
            [['shopName', 'sellerName'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'balanceApplyId' => 'Balance Apply ID',
            'goodsId' => 'Goods ID',
            'goodsNumber' => 'Goods Number',
            'consumeSaleStream' => 'Consume Sale Stream',
            'payablePrice' => 'Payable Price',
            'costPrice' => 'Cost Price',
            'verificationCode' => 'Verification Code',
            'verificaterAccount' => 'Verificater Account',
            'verificateTime' => 'Verificate Time',
            'membershipCardNumber' => 'Membership Card Number',
            'userAccount' => 'User Account',
            'userDiscount' => 'User Discount',
            'orderId' => 'Order ID',
            'shopId' => 'Shop ID',
            'shopName' => 'Shop Name',
            'sellerId' => 'Seller ID',
            'sellerName' => 'Seller Name',
        ];
    }
}
