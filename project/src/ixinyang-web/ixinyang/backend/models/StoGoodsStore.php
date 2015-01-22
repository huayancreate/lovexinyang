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
            [['goodsId', 'storeId','inventory'], 'required','message' => '{attribute}不能为空.'],
            [['goodsId', 'storeId', 'sellerId', 'inventory', 'crreteUserID','goodsState'], 'integer'],
            [['createDate'], 'safe'],
            [['enjoyRebate'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sgsId' => 'sgsId',
            'goodsId' => '商品id',
            'storeId' => '店铺id',
            'sellerId' => '商家id',
            'inventory' => '商品库存',
            'createDate' => '创建时间',
            'crreteUserID' => '创建人',
            'enjoyRebate' => '是否享受会员折扣', //是否享受会员折扣
        ];
    }
    /**
     * [getGoodsState 获取商品状态]
     * @param  [type] $index [description]
     * @return [type]        [description]
     */
    public function getGoodsState($index){
        switch ($index) {
            case '0':
                return "待发布";
                break;
            case '1':
                return "已发布";
                break;
            case '2':
                return "已下架";
                break;
        }
    }
}
