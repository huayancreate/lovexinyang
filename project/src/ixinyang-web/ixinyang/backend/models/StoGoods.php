<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_goods".
 *
 * @property integer $id
 * @property string $goodsName
 * @property string $summary
 * @property resource $describes
 * @property double $price
 * @property string $subClass
 * @property string $validity
 * @property string $supplyDateTime
 * @property string $enjoyRebate
 * @property integer $goodsGrade
 * @property integer $goodsWeight
 * @property integer $goodsState
 * @property string $createDate
 * @property integer $createID
 * @property string $createName
 */
class StoGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['describes'], 'string'],
            [['price'], 'number'],
            [['supplyDateTime', 'createDate'], 'safe'],
            [['goodsGrade', 'goodsWeight', 'goodsState', 'createID'], 'integer'],
            [['goodsName'], 'string', 'max' => 150],
            [['summary'], 'string', 'max' => 200],
            [['subClass'], 'string', 'max' => 50],
            [['validity', 'enjoyRebate'], 'string', 'max' => 2],
            [['createName'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsName' => 'Goods Name',
            'summary' => 'Summary',
            'describes' => 'Describes',
            'price' => 'Price',
            'subClass' => 'Sub Class',
            'validity' => 'Validity',
            'supplyDateTime' => 'Supply Date Time',
            'enjoyRebate' => 'Enjoy Rebate',
            'goodsGrade' => 'Goods Grade',
            'goodsWeight' => 'Goods Weight',
            'goodsState' => 'Goods State',
            'createDate' => 'Create Date',
            'createID' => 'Create ID',
            'createName' => 'Create Name',
        ];
    }
}
