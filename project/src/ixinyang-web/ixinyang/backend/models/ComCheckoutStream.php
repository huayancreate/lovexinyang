<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_checkout_stream".
 *
 * @property integer $id
 * @property integer $operatorId
 * @property string $operatorAccount
 * @property string $operatorTime
 * @property string $depositAlipayName
 * @property string $depositAlipayAccount
 * @property string $interfaceSerialNumber
 * @property double $balanceMoney
 * @property integer $balanceApplyId
 * @property string $balanceTime
 * @property integer $storeId
 * @property string $storeName
 * @property string $expenditureAlipayName
 * @property string $expenditureAlipayAccount
 * @property string $alipayTransactionStream
 * @property string $payTime
 */
class ComCheckoutStream extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_checkout_stream';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operatorId', 'balanceApplyId', 'storeId'], 'integer'],
            [['operatorTime', 'balanceTime', 'payTime'], 'safe'],
            [['balanceMoney'], 'number'],
            [['operatorAccount', 'depositAlipayName', 'depositAlipayAccount', 'interfaceSerialNumber', 'storeName', 'expenditureAlipayName', 'expenditureAlipayAccount', 'alipayTransactionStream'], 'string', 'max' => 50],
            [['alipayNo'], 'string', 'max' => 40],
            [['alipayName'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operatorId' => 'Operator ID',
            'operatorAccount' => 'Operator Account',
            'operatorTime' => 'Operator Time',
            'depositAlipayName' => 'Deposit Alipay Name',
            'depositAlipayAccount' => 'Deposit Alipay Account',
            'interfaceSerialNumber' => 'Interface Serial Number',
            'balanceMoney' => 'Balance Money',
            'balanceApplyId' => 'Balance Apply ID',
            'balanceTime' => 'Balance Time',
            'storeId' => 'Store ID',
            'storeName' => 'Store Name',
            'expenditureAlipayName' => 'Expenditure Alipay Name',
            'expenditureAlipayAccount' => 'Expenditure Alipay Account',
            'alipayTransactionStream' => 'Alipay Transaction Stream',
            'payTime' => 'Pay Time',
        ];
    }
}
