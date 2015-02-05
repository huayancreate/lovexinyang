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
    public $fileWeb;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_advertisement';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['add'] = ['mapLink', 'mapOrder','adName', 'startDate', 'endDate','createrId', 'mapLocation','createTime', 'photoUrl','isValid','adType','file','fileWeb'];
        $scenarios['update'] = ['mapLink', 'mapOrder','adName', 'startDate', 'endDate','createrId', 'mapLocation','createTime', 'photoUrl','isValid','adType','file','fileWeb'];
        $scenarios['updateoldphoto'] = ['mapLink', 'mapOrder','adName', 'startDate', 'endDate','createrId', 'mapLocation','createTime', 'photoUrl','isValid','adType'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
       $phonefile = function($model) { return $model->adType =="1"; };
       $webfile = function($model) { return $model->adType =="2"; };

        return [
             //去掉前后空格
            [['mapLink','mapOrder','adName'],'trim'],//, 'mapLocation'
            //必填
            //[['mapLink','mapOrder'],'unique','message'=>'{attribute}已经存在'],
            [['mapLink','mapOrder', 'startDate', 'endDate',],'required','message'=>'{attribute}不能为空'],
          
            [['createrId', 'mapOrder', 'mapLocation'], 'integer'],
            [['createTime', 'updateTime', 'endDate', 'startDate'], 'safe'],
            [['mapLink', 'adName', 'photoUrl'], 'string', 'max' => 200],
            [['isValid','adType'], 'string', 'max' => 1],
            [['mapLink'],'url','message'=>'请输入正确的链接地址'],
            
             [['file'],'image',
                      'maxHeight'=>1200,'overHeight'=>'图片超过了指定高度',
                      'maxWidth'=>1200, 'overWidth'=>'图片超过了指定宽度',
                      'maxSize'=>1024*1024*2,'tooBig'=>'图片过大',
                      'skipOnError'=>0,
                      'skipOnEmpty'=>0,
                      'uploadRequired'=>'请上传文件！',
                      'when' => $phonefile,
                      'on'=>'update',
            ],

             [['fileWeb'],'image',
                      'maxHeight'=>1200,'overHeight'=>'图片超过了指定高度',
                      'maxWidth'=>1200, 'overWidth'=>'图片超过了指定宽度',
                      'maxSize'=>1024*1024*2,'tooBig'=>'图片过大',
                      'skipOnError'=>0,
                      'skipOnEmpty'=>0,
                      'uploadRequired'=>'请上传文件！',
                      'when' => $webfile,
                      'on'=>'update',
            ],

            [['file'],'image',
                      'maxHeight'=>1200,'overHeight'=>'图片超过了指定高度',
                      'maxWidth'=>1200, 'overWidth'=>'图片超过了指定宽度',
                      'maxSize'=>1024*1024*2,'tooBig'=>'图片过大',
                      'skipOnError'=>0,
                      'skipOnEmpty'=>0,
                      'uploadRequired'=>'请上传文件！',
                      'when' => $phonefile,
                      'on'=>'add',
            ],

            [['fileWeb'],'image',
                      'maxHeight'=>1200,'overHeight'=>'图片超过了指定高度',
                      'maxWidth'=>1200, 'overWidth'=>'图片超过了指定宽度',
                      'maxSize'=>1024*1024*2,'tooBig'=>'图片过大',
                      'skipOnError'=>0,
                      'skipOnEmpty'=>0,
                      'uploadRequired'=>'请上传文件！',
                      'when' => $webfile,
                      'on'=>'add',
            ],
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
            'adType'=>'广告类型',
            'file'=>'上传图片',
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
