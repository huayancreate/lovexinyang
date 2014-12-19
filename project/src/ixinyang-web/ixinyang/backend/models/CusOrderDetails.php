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
            'orderId' => 'Order ID',
            'goodsName' => 'Goods Name',
            'goodsId' => 'Goods ID',
            'price' => 'Price',
            'totalPrice' => 'Total Price',
            'rebate' => 'Rebate',
            'rebatePrice' => 'Rebate Price',
            'totalNum' => 'Total Num',
            'sellerId' => 'Seller ID',
            'memberCardNo' => 'Member Card No',
        ];
    }
}
