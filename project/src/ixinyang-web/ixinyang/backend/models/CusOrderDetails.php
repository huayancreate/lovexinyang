<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cus_order_details".
 *
 * @property integer $id
 * @property integer $orderId
 * @property string $goodsName
 * @property integer $goodsId
 * @property double $price
 * @property double $totalPrice
 * @property string $rebate
 * @property double $rebatePrice
 * @property integer $totalNum
 * @property integer $sellerId
 * @property string $memberCardNo
 */
class CusOrderDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_order_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderId', 'goodsId', 'totalNum', 'sellerId'], 'integer'],
            [['price', 'totalPrice', 'rebatePrice'], 'number'],
            [['goodsName', 'rebate', 'memberCardNo'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'orderId' => '订单ID',
            'goodsName' => '商品名称',
            'goodsId' => '商品ID',
            'price' => '商品价格',
            'totalPrice' => '商品总价',
            'rebate' => '折扣',
            'rebatePrice' => '折扣价格',
            'totalNum' => '商品数量',
            'sellerId' => '商家ID',
            'memberCardNo' => '会员卡卡号',
        ];
    }
}
