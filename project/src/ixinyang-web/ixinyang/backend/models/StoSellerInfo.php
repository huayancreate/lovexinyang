<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sto_seller_info".
 *
 * @property integer $id
 * @property integer $customerManager
 * @property integer $contractId
 * @property string $otherContactWay
 * @property string $summary
 * @property string $sellerName
 * @property string $validity
 * @property string $contacts
 * @property string $phone
 * @property string $email
 * @property double $accountBalance
 * @property string $owner
 */
class StoSellerInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sto_seller_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customerManager', 'contractId'], 'integer'],
            [['accountBalance'], 'number'],
            [['otherContactWay', 'contacts', 'email', 'owner'], 'string', 'max' => 50],
            [['summary'], 'string', 'max' => 200],
            [['sellerName'], 'string', 'max' => 150],
            [['validity'], 'string', 'max' => 2],
            [['phone'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerManager' => 'Customer Manager',
            'contractId' => 'Contract ID',
            'otherContactWay' => 'Other Contact Way',
            'summary' => 'Summary',
            'sellerName' => 'Seller Name',
            'validity' => 'Validity',
            'contacts' => 'Contacts',
            'phone' => 'Phone',
            'email' => 'Email',
            'accountBalance' => 'Account Balance',
            'owner' => 'Owner',
        ];
    }
}
