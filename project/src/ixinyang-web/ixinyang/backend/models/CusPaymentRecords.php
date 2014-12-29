<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cus_payment_records".
 *
 * @property integer $id
 * @property string $recordsNo
 * @property integer $orderId
 * @property string $orderNo
 * @property double $orderTotalPrice
 * @property double $remainingSum
 * @property double $otherPaymentAmount
 * @property string $paymentTime
 * @property integer $userId
 * @property string $userAccount
 * @property integer $sellerId
 * @property string $sellerName
 * @property integer $shopId
 * @property string $shopName
 */
class CusPaymentRecords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_payment_records';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'userId', 'sellerId', 'shopId'], 'integer'],
            [['orderTotalPrice', 'remainingSum', 'otherPaymentAmount'], 'number'],
            [['paymentTime'], 'safe'],
            [['recordsNo', 'orderNo', 'userAccount', 'sellerName'], 'string', 'max' => 50],
            [['shopName'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recordsNo' => 'Records No',
            'orderId' => 'Order ID',
            'orderNo' => 'Order No',
            'orderTotalPrice' => 'Order Total Price',
            'remainingSum' => 'Remaining Sum',
            'otherPaymentAmount' => 'Other Payment Amount',
            'paymentTime' => 'Payment Time',
            'userId' => 'User ID',
            'userAccount' => 'User Account',
            'sellerId' => 'Seller ID',
            'sellerName' => 'Seller Name',
            'shopId' => 'Shop ID',
            'shopName' => 'Shop Name',
        ];
    }
}
