<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_goods_store".
 *
 * @property integer $sgsId
 * @property integer $goodsId
 * @property integer $storeId
 * @property integer $sellerId
 * @property integer $inventory
 * @property string $createDate
 * @property integer $crreteUserID
 */
class StoGoodsStore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_goods_store';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsId', 'storeId'], 'required'],
            [['goodsId', 'storeId', 'sellerId', 'inventory', 'crreteUserID'], 'integer'],
            [['createDate'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sgsId' => 'Sgs ID',
            'goodsId' => 'Goods ID',
            'storeId' => 'Store ID',
            'sellerId' => 'Seller ID',
            'inventory' => 'Inventory',
            'createDate' => 'Create Date',
            'crreteUserID' => 'Crrete User ID',
        ];
    }
}
