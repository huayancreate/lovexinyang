<?php

namespace app\models;
°¢ÈøµÂÈöµÄ
use Yii;

/**
 * This is the model class for table "ad_push_message".
 *
 * @property integer $id
 * @property string $area
 * @property integer $toAge
 * @property integer $fromAge
 * @property string $isValid
 * @property resource $pushIntroduction
 * @property string $pushTime
 * @property resource $pushDetails
 * @property string $pushSex
 * @property resource $messageTopic
 * @property integer $membershipGrade
 */
class AdPushMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad_push_message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['toAge', 'fromAge', 'membershipGrade'], 'integer'],
            [['pushIntroduction', 'pushDetails', 'messageTopic'], 'string'],
            [['pushTime'], 'safe'],
            [['area'], 'string', 'max' => 200],
            [['isValid'], 'string', 'max' => 1],
            [['pushSex'], 'string', 'max' => 4]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'area' => 'Area',
            'toAge' => 'To Age',
            'fromAge' => 'From Age',
            'isValid' => 'Is Valid',
            'pushIntroduction' => 'Push Introduction',
            'pushTime' => 'Push Time',
            'pushDetails' => 'Push Details',
            'pushSex' => 'Push Sex',
            'messageTopic' => 'Message Topic',
            'membershipGrade' => 'Membership Grade',
        ];
    }
}
