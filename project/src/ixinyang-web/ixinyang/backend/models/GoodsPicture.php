<?php

namespace backend\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "goodspicture".
 *
 * @property integer $id
 * @property integer $goodsId
 * @property string $path
 * @property string $attribute
 * @property string $renewTime
 * @property string $classification
 * @property string $uploadPersonnel
 */
class GoodsPicture extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     * 商品图片信息
     */
    public static function tableName()
    {
        return 'goodspicture';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsId'], 'integer'],
            [['renewTime'], 'safe'],
            [['path', 'classification', 'uploadPersonnel'], 'string', 'max' => 50],
            [['attribute'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '自增列',
            'goodsId' => '商品ID',
            'path' => '图片路径',
            'attribute' => '属性',
            'renewTime' => '更新时间',
            'classification' => '类别',
            'uploadPersonnel' => '上传人员',
        ];
    }

    /**
     * 根据商品ID获取图片
     * @param  [type] $goodsId [description]
     * @return [type] 图片路径集合
     */
    public function getPicture($goodsId){
        $picList=GoodsPicture::find()->where(['goodsId' => $goodsId])->all();
        $pic=array();
        for ($i=0; $i <count($picList) ; $i++) { 
            $pic[$i]=Html::img($picList[$i]["path"], ['class'=>'file-preview-image']);
        }
        return $pic;
    }
}
