<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cus_order".
 *
 * @property integer $id
 * @property integer $orderNo
 * @property double $totalPrice
 * @property string $userAccount
 * @property string $userName
 * @property double $payTotalPrice
 * @property string $buyTime
 * @property string $methodsPayment
 * @property string $paymentAccount
 */
class CusOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderNo'], 'integer'],
            [['totalPrice', 'payTotalPrice'], 'number'],
            [['buyTime'], 'safe'],
            [['userAccount', 'userName', 'methodsPayment', 'paymentAccount'], 'string', 'max' => 50]
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
            'totalPrice' => 'Total Price',
            'userAccount' => 'User Account',
            'userName' => 'User Name',
            'payTotalPrice' => 'Pay Total Price',
            'buyTime' => 'Buy Time',
            'methodsPayment' => 'Methods Payment',
            'paymentAccount' => 'Payment Account',
        ];
    }
}
