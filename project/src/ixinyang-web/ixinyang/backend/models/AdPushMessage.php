<?php

namespace backend\models;

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
            'area' => '地区',
            'toAge' => '从年龄',
            'fromAge' => '到年龄',
            'isValid' => '有消息',
            'pushIntroduction' => '推送简介',
            'pushTime' => '推送时间',
            'pushDetails' => '推送内容',
            'pushSex' => '推送性别',
            'messageTopic' => '推送主题',
            'membershipGrade' => '会员等级',
        ];
    }

    /**
     * app广告推送
     *
     */
    public function sendMessage()
    {
        $model = new ComMessageBox();
        if (Yii::$app->request->post()) {

            $sex = $_POST['sex'];
            $memberGrade = "";
            $fromAge = $_POST['fromAge'];
            $toAge = $_POST['toAge'];
            $title = $_POST['title'];
            $introduction = $_POST['introduction'];
            $content = $_POST['content'];
            //1.根据条件查询所有符合要求的用户
            $users = $model->getUserByCondition($sex, $memberGrade, $fromAge, $toAge);
            foreach ($users as $user) {
                //2.保存消息到消息盒子中
                $adPush = new AdPushMessage();
                $adPush->messageTopic = $title;
                $adPush->pushIntroduction = $introduction;
                $adPush->pushDetails = $content;
                $adPush->membershipGrade = $user->memberGrade;
                $adPush->pushSex = $sex;
                $adPush->pushTime = date('Y-m-d H:i:s');
                $adPush->isValid = "1";
                $adPush->fromAge = $fromAge;
                $adPush->toAge = $toAge;
                $adPush->save();
            }
        }
    }

}
