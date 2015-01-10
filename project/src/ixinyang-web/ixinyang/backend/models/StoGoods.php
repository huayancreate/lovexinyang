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
     * @var UploadedFile|Null file attribute
     */
    public $file;

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
            [['goodsName'],'required','message' => '{attribute}不能为空.'],
            [['describes'], 'string'],
            [['price'], 'number'],
            [['createDate'], 'safe'],
            [['goodsGrade', 'goodsWeight', 'createID','subClass'], 'integer'],
            [['goodsName','supplyDateTime'], 'string', 'max' => 150],
            [['summary'], 'string', 'max' => 200],
            [['validity'], 'string', 'max' => 2],
            [['createName'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodsName' => '名称',
            'summary' => '概述',
            'describes' => '描述',
            'price' => '价格',
            'subClass' => '类别',
            'validity' => '是否有效',
            'supplyDateTime' => '供应时间',
            'goodsGrade' => '等级',
            'goodsWeight' => '权重',
            'createDate' => '创建日期',
            'createID' => '创建人ID',
            'createName' => '创建人',
            'file'=>'文件'
        ];
    }
}
