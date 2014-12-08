<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods_apply_info".
 *
 * @property integer $id
 * @property integer $shopId
 * @property string $shopName
 * @property integer $stock
 * @property integer $enterId
 * @property string $enterAccount
 * @property integer $storeId
 * @property string $storeName
 * @property string $supplyTime
 * @property double $goodsPrice
 * @property resource $goodsIntroduction
 * @property integer $goodsType
 * @property resource $goodsDescription
 * @property string $goodsName
 * @property string $goodsValidityDate
 * @property integer $goodsId
 * @property integer $goodsStatus
 * @property string $memberDiscount
 */
class GoodsApplyInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_apply_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopId', 'stock', 'enterId', 'storeId', 'goodsType', 'goodsId', 'goodsStatus'], 'integer'],
            [['supplyTime', 'goodsValidityDate'], 'safe'],
            [['goodsPrice'], 'number'],
            [['goodsIntroduction', 'goodsDescription'], 'string'],
            [['shopName', 'enterAccount', 'storeName', 'goodsName'], 'string', 'max' => 50],
            [['memberDiscount'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shopId' => 'Shop ID',
            'shopName' => 'Shop Name',
            'stock' => 'Stock',
            'enterId' => 'Enter ID',
            'enterAccount' => 'Enter Account',
            'storeId' => 'Store ID',
            'storeName' => 'Store Name',
            'supplyTime' => 'Supply Time',
            'goodsPrice' => 'Goods Price',
            'goodsIntroduction' => 'Goods Introduction',
            'goodsType' => 'Goods Type',
            'goodsDescription' => 'Goods Description',
            'goodsName' => 'Goods Name',
            'goodsValidityDate' => 'Goods Validity Date',
            'goodsId' => 'Goods ID',
            'goodsStatus' => 'Goods Status',
            'memberDiscount' => 'Member Discount',
        ];
    }
}
