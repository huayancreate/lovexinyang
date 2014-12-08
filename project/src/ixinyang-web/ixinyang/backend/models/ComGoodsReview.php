<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "com_goods_review".
 *
 * @property integer $cgrId
 * @property integer $goodsId
 * @property string $goodsName
 * @property integer $applyerId
 * @property string $applyerAccount
 * @property string $applyTime
 * @property integer $reviewerId
 * @property string $reviewerName
 * @property integer $reviewTaskId
 * @property string $reviewTime
 * @property integer $reviewStatus
 * @property string $remark
 */
class ComGoodsReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_goods_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsId', 'applyerId', 'reviewerId', 'reviewTaskId', 'reviewStatus'], 'integer'],
            [['applyTime', 'reviewTime'], 'safe'],
            [['goodsName'], 'string', 'max' => 300],
            [['applyerAccount', 'reviewerName'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cgrId' => 'Cgr ID',
            'goodsId' => 'Goods ID',
            'goodsName' => 'Goods Name',
            'applyerId' => 'Applyer ID',
            'applyerAccount' => 'Applyer Account',
            'applyTime' => 'Apply Time',
            'reviewerId' => 'Reviewer ID',
            'reviewerName' => 'Reviewer Name',
            'reviewTaskId' => 'Review Task ID',
            'reviewTime' => 'Review Time',
            'reviewStatus' => 'Review Status',
            'remark' => 'Remark',
        ];
    }
}
