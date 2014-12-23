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
            'id' => 'ID',
            'operatorId' => 'Operator ID',
            'operatorName' => 'Operator Name',
            'createTime' => 'Create Time',
            'memberRating' => 'Member Rating',
            'upperLimit' => 'Upper Limit',
            'lowerLimit' => 'Lower Limit',
            'ico' => 'Ico',
            'memberName' => 'Member Name',
            'rebate' => 'Rebate',
            'sellerId' => 'Seller ID',
            'sellerName' => 'Seller Name',
            'validity' => 'Validity',
            'modifyTime' => 'Modify Time',
        ];
    }
}
