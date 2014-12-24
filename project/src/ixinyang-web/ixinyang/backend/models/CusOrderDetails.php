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
            [['orderId', 'goodsId', 'totalNum', 'sellerId', 'shopId', 'CodeStatus'], 'integer'],
            [['price', 'totalPrice', 'rebatePrice'], 'number'],
            [['goodsName', 'rebate', 'memberCardNo','validateCodeHash'], 'string', 'max' => 50],
            [['shopName'], 'string', 'max' => 100],
            [['validateCode'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增列',
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
            'shopId' => '店铺id',
            'shopName' => '店铺名称',
            'validateCode' => '验证码',
            'CodeStatus' => '验证码状态', //： 0 未生成 1 已付款 2 已消费 3已退款
            'validateCodeHash' => '加密验证码',
        ];
    }

    public function getCodeStatus($index){
        switch ($index) {
            case '0':
                return "<b style='color:red'>未付款</b>";
                break;
            case '1':
                return "<b style='color:#FF8C00'>未消费</b>";
                break;
            case '2':
                return "<b style='color:#008000'>已消费</b>";
                break;
            case '3':
                return "<b style='color:#A0522D'>已退费</b>";
                break;
        }
    }
}
