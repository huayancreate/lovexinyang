<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\Html;

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
     * @var UploadedFile file attribute
     */
    public $file;

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
            // [['photoUrl'], 'file', 'extensions' => 'gif, jpg',],
             //去掉前后空格
            [['photoUrl','mapLink','mapOrder','adName'],'trim'],
            //必填
            [['mapLink','mapOrder', 'startDate', 'endDate'],'required','message'=>'{attribute}不能为空'],
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

    /**
     * [getPicture 根据广告id获取广告路径 显示对应图片]
     * @param  [type] $adId [主键id]
     * @return [type]       [description]
     */
    public function getPicture($adId){
        $picList=Ad::find()->where(['id' => $adId])->all();
        $pic=array();
        for ($i=0; $i <count($picList) ; $i++) { 
            $pic[$i]=Html::img($picList[$i]["photoUrl"], ['class'=>'file-preview-image']);
        }
        return $pic;
    }
}
