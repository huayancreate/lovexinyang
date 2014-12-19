<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ad_recommend_goods".
 *
 * @property integer $id
 * @property string $creater
 * @property string $createTime
 * @property integer $adLocation
 * @property string $endDate
 * @property string $startDate
 * @property integer $ad_recommend_goods
 * @property string $isValid
 * @property string $ad_advertisement
 * @property integer $order
 */
class AdRecommendGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_recommend_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createTime', 'endDate', 'startDate'], 'safe'],
            [['creater','adLocation', 'ad_recommend_goods', 'order'], 'integer'],
            [['isValid', 'ad_advertisement'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'creater' => '创建人id',
            'createTime' => '创建时间',
            'adLocation' => '广告位置',
            'endDate' => '结束时间(有效期)',
            'startDate' => '开始日期(有效期)',
            'ad_recommend_goods' => '对应名称',
            'isValid' => '是否有效',
            'ad_advertisement' => '推荐类型',
            'order' => '顺序',
        ];  
    }
}
