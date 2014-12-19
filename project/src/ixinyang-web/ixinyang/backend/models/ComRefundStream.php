<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_refund_stream".
 *
 * @property integer $id
 * @property integer $operatorId
 * @property string $operatorAccount
 * @property string $operateTime
 * @property string $loadTime
 * @property string $loadAlipayName
 * @property string $loadAlipayAccount
 * @property double $refundMoney
 * @property integer $refundStreamId
 * @property string $refundTime
 * @property integer $refundApplyId
 * @property string $refundApplyTime
 * @property string $verificationCode
 * @property integer $userId
 * @property string $userAccount
 * @property string $payAlipayName
 * @property string $payAlipayAccount
 * @property integer $alipayStreamNumber
 */
class ComRefundStream extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_refund_stream';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operatorId', 'refundStreamId', 'refundApplyId', 'userId', 'alipayStreamNumber'], 'integer'],
            [['operateTime', 'loadTime', 'refundTime', 'refundApplyTime'], 'safe'],
            [['refundMoney'], 'number'],
            [['operatorAccount', 'verificationCode', 'payAlipayName'], 'string', 'max' => 50],
            [['loadAlipayName', 'loadAlipayAccount', 'userAccount', 'payAlipayAccount'], 'string', 'max' => 250]
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
            'operateTime' => 'Operate Time',
            'loadTime' => 'Load Time',
            'loadAlipayName' => 'Load Alipay Name',
            'loadAlipayAccount' => 'Load Alipay Account',
            'refundMoney' => 'Refund Money',
            'refundStreamId' => 'Refund Stream ID',
            'refundTime' => 'Refund Time',
            'refundApplyId' => 'Refund Apply ID',
            'refundApplyTime' => 'Refund Apply Time',
            'verificationCode' => 'Verification Code',
            'userId' => 'User ID',
            'userAccount' => 'User Account',
            'payAlipayName' => 'Pay Alipay Name',
            'payAlipayAccount' => 'Pay Alipay Account',
            'alipayStreamNumber' => 'Alipay Stream Number',
        ];
    }
}
