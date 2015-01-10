<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_member_rule".
 *
 * @property integer $id
 * @property integer $operatorId
 * @property string $operatorName
 * @property string $createTime
 * @property integer $memberRating
 * @property integer $upperLimit
 * @property string $lowerLimit
 * @property string $ico
 * @property string $memberName
 * @property string $rebate
 * @property integer $sellerId
 * @property string $sellerName
 * @property string $validity
 * @property string $modifyTime
 */
class StoMemberRule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_member_rule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operatorId', 'memberRating', 'upperLimit', 'lowerLimit', 'sellerId'], 'integer'],
            [['createTime', 'modifyTime'], 'safe'],
            [['operatorName', 'ico', 'memberName'], 'string', 'max' => 50],
            [['rebate'], 'string', 'max' => 5],
            [['sellerName'], 'string', 'max' => 150],
            [['validity'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID 自增列',
            'operatorId' => '操作人ID',
            'operatorName' => '操作人名称',
            'createTime' => '创建时间',
            'memberRating' => '会员等级',
            'upperLimit' => '会员积分上限',
            'lowerLimit' => '会员积分下限',
            'ico' => '会员等级图标',
            'memberName' => '会员名称',
            'rebate' => '折扣',
            'sellerId' => '商家ID',
            'sellerName' => '商家名称',
            'validity' => '是否有效',
            'modifyTime' => '修改时间',
        ];
    }
}
