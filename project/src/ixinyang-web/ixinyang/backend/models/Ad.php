<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ad_advertisement".
 *
 * @property integer $id
 * @property integer $createrId
 * @property string $createTime
 * @property string $mapLink
 * @property integer $mapOrder
 * @property integer $mapLocation
 * @property string $updateTime
 * @property string $adName
 * @property string $endDate
 * @property string $startDate
 * @property string $isValid
 * @property string $photoUrl
 */
class Ad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_advertisement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             //去掉前后空格
            [['photoUrl','mapLink','mapOrder','adName'],'trim'],
            //必填
            [['photoUrl','mapLink','mapOrder', 'startDate', 'endDate'],'required','message'=>'{attribute}不能为空'],
            [['photoUrl','mapLink','mapOrder'],'unique','message'=>'{attribute}已经存在'],
            [['createrId', 'mapOrder', 'mapLocation'], 'integer'],
            [['createTime', 'updateTime', 'endDate', 'startDate'], 'safe'],
            [['mapLink', 'adName', 'photoUrl'], 'string', 'max' => 200],
            [['isValid'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createrId' => '创建人员ID',
            'createTime' => '创建时间',
            'mapLink' => '对应链接',
            'mapOrder' => '排序',
            'mapLocation' => '对应位置',
            'updateTime' => '更新时间',
            'adName' => '广告名称',
            'endDate' => '结束日期(有效期)',
            'startDate' => '开始日期(有效期)',
            'isValid' => '是否有效',
            'photoUrl' => '广告图片',
        ];
    }
}
