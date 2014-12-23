<?php

namespace backend\models;

use Yii;


/**
 * This is the model class for table "cus_electronic_card".
 *
 * @property integer $id
 * @property integer $memberId
 * @property string $memberCardNumber
 * @property string $sellerName
 * @property integer $userIndividualCenterId
 * @property integer $userId
 */
class CusElectronicCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_electronic_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['memberId', 'userIndividualCenterId', 'userId'], 'integer'],
            [['memberCardNumber', 'sellerName'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键 自助增长',
            'memberId' => '会员等级ID',
            'memberCardNumber' => '会员卡卡号',
            'sellerName' => '商家名称',
            'userIndividualCenterId' => '用户个人中心ID',
            'userId' => '用户帐号id',
        ];
    }

    // /**
    //  * 根据
    //  * @param  [type] $memberCode [description]
    //  * @return [type]             [description]
    //  */
    public function getMemberRule($memberCode){

        return CusElectronicCard::hasMany(StoMemberRule::className(),['memberId'=>'id'])
                    ->where(['memberCardNumber'=>$memberCode]);
    }

}
