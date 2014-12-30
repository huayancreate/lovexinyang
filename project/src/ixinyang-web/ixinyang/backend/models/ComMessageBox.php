<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "com_message_box".
 *
 * @property integer $id
 * @property string $seeDate
 * @property string $sendOutDate
 * @property integer $recipientsId
 * @property string $recipientsName
 * @property string $readState
 * @property string $summary
 * @property resource $content
 * @property string $title
 */
class ComMessageBox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_message_box';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seeDate', 'sendOutDate'], 'safe'],
            [['recipientsId'], 'integer'],
            [['content'], 'string'],
            [['recipientsName'], 'string', 'max' => 50],
            [['readState'], 'string', 'max' => 2],
            [['summary'], 'string', 'max' => 200],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seeDate' => '查看时间',
            'sendOutDate' => '发出时间',
            'recipientsId' => '收件人Id',
            'recipientsName' => '收件人姓名',
            'readState' => '读取状态',
            'summary' => '消息概述',
            'content' => '消息内容',
            'title' => '消息主题',
        ];
    }


    public function sendMessage()
    {
        //1.根据条件查询所有符合要求的用户
        if (Yii::$app->request->post()) {
            $sex = $_POST['sex'];
            $memberGrade = $_POST['memberGrade'];
            $fromAge = $_POST['fromAge'];
            $toAge = $_POST['toAge'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $users = $this->getUserByCondition($sex, $memberGrade, $fromAge, $toAge);
            foreach ($users as $user) {
                $model = new ComMessageBox();
                //2.保存消息到消息盒子中
                $model->recipientsId = $user->id;
                $model->recipientsName = $user->userName;
                $model->readState = '0';
                $model->sendOutDate = date('Y-m-d H:i:s');
                $model->title = $title;
                $model->content = $content;
                $model->save();
            }
        }
    }

    /**
     *
     */
    public function getUserByCondition($sex, $memberGrade, $formAge, $toAge)
    {
        $fromDate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - $toAge));
        $toDate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y') - $formAge));

        $dataProvider = CusUserIndividualCenter::find()->
        andWhere(['validity' => '1']);

        if (!empty($sex)) {
            $dataProvider->andWhere(['sex' => $sex]);
        }
        if (!empty($memberGrade)) {
            $dataProvider->andWhere(['memberGrade' => $memberGrade]);
        }
        if (!empty($formAge)) {
            $dataProvider->andWhere(['BETWEEN', 'birthday', $fromDate, $toDate]);
        }
        return $dataProvider->all();
    }

    /**
     * 根据商家Id获取当前商家的会员等级
     * @param $stoId
     */
    public function getStoMemberRule($stoId)
    {
        return StoMemberRule::find()->where(['validity' => '1', 'sellerId' => $stoId])->all();
    }
}
