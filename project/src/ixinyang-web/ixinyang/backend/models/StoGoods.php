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
            [['goodsName'],'required','message' => '{attribute}����Ϊ��.'],
            [['describes'], 'string'],
            [['price'], 'number'],
            [['supplyDateTime', 'createDate'], 'safe'],
            [['goodsGrade', 'goodsWeight', 'goodsState', 'createID'], 'integer'],
            [['goodsName'], 'string', 'max' => 150],
            [['summary'], 'string', 'max' => 200],
            [['subClass'], 'string', 'max' => 1],
            [['validity', 'enjoyRebate'], 'string', 'max' => 2],
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
            'goodsName' => '����',
            'summary' => '����',
            'describes' => '����',
            'price' => '�۸�',
            'subClass' => '���',
            'validity' => '�Ƿ���Ч',
            'supplyDateTime' => '��Ӧʱ��',
            'enjoyRebate' => '��Ա�ۿ�', //�Ƿ����ܻ�Ա�ۿ�
            'goodsGrade' => '�ȼ�',
            'goodsWeight' => 'Ȩ��',
            'goodsState' => '״̬',
            'createDate' => '��������',
            'createID' => '������ID',
            'createName' => '������',
        ];
    }
}
