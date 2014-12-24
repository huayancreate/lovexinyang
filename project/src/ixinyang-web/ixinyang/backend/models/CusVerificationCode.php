<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cus_verification_code".
 *
 * @property integer $id
 * @property integer $orderDetailsId
 * @property string $verificationCode
 * @property integer $goodsId
 * @property string $orderNo
 * @property integer $number
 * @property double $costPrice
 * @property double $payablePrice
 * @property string $state
 */
class CusVerificationCode extends \yii\db\ActiveRecord
{
    /**
     * @验证码明细
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_verification_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderDetailsId', 'goodsId', 'number'], 'integer'],
            [['costPrice', 'payablePrice'], 'number'],
            [['verificationCode', 'orderNo'], 'string', 'max' => 50],
            [['state'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增列',
            'orderDetailsId' => '订单详情ID',
            'verificationCode' => '验证码',
            'goodsId' => '商品ID',
            'orderNo' => '订单编号',
            'number' => '数量',
            'costPrice' => '原价',
            'payablePrice' => '应付价格',
            'state' => '状态',
        ];
    }
}
