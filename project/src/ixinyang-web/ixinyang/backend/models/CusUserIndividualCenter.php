<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cus_user_individual_center".
 *
 * @property integer $id
 * @property integer $userAccountId
 * @property string $birthday
 * @property string $validity
 * @property string $phone
 * @property integer $memberGrade
 * @property double $consumptionAmount
 * @property string $interest
 * @property string $sex
 * @property string $userName
 * @property string $userAccount
 * @property string $email
 * @property double $spareAmount
 * @property string $profession
 * @property string $registrationDate
 */
class CusUserIndividualCenter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cus_user_individual_center';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userAccountId', 'memberGrade'], 'integer'],
            [['birthday', 'registrationDate'], 'safe'],
            [['consumptionAmount', 'spareAmount'], 'number'],
            [['validity', 'sex'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 20],
            [['interest'], 'string', 'max' => 100],
            [['userName', 'userAccount', 'email', 'profession'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userAccountId' => 'User Account ID',
            'birthday' => 'Birthday',
            'validity' => 'Validity',
            'phone' => 'Phone',
            'memberGrade' => 'Member Grade',
            'consumptionAmount' => 'Consumption Amount',
            'interest' => 'Interest',
            'sex' => 'Sex',
            'userName' => 'User Name',
            'userAccount' => 'User Account',
            'email' => 'Email',
            'spareAmount' => 'Spare Amount',
            'profession' => 'Profession',
            'registrationDate' => 'Registration Date',
        ];
    }
}
