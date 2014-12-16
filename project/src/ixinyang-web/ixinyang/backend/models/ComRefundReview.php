<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "com_refund_review".
 *
 * @property integer $id
 * @property integer $financeId
 * @property string $financeAccount
 * @property string $financeReviewTime
 * @property integer $financeReviewStatus
 * @property integer $reviewId
 * @property string $reviewAccount
 * @property string $reviewTime
 * @property integer $reviewStatus
 * @property integer $orderId
 * @property string $orderName
 * @property string $busiName
 * @property integer $busiId
 * @property string $storeName
 * @property integer $storeId
 * @property string $applyTime
 * @property double $refundMoney
 * @property string $refundReason
 * @property string $verificationCode
 * @property string $userName
 * @property string $userAccount
 */
class ComRefundReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_refund_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['financeId', 'financeReviewStatus', 'reviewId', 'reviewStatus', 'orderId', 'busiId', 'storeId'], 'integer'],
            [['financeReviewTime', 'reviewTime', 'applyTime'], 'safe'],
            [['refundMoney'], 'number'],
            [['financeAccount', 'reviewAccount', 'orderName', 'busiName', 'storeName', 'verificationCode', 'userName', 'userAccount'], 'string', 'max' => 50],
            [['refundReason'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'financeId' => '财务人员ID',
            'financeAccount' => '财务人员账号',
            'financeReviewTime' => '财务审核时间',
            'financeReviewStatus' => '财务审核状态',
            'reviewId' => '初审人ID',
            'reviewAccount' => '初审人账号',
            'reviewTime' => '初审时间',
            'reviewStatus' => '初审状态',
            'orderId' => '订单ID',
            'orderName' => '订单名称',
            'busiName' => '商家名称',
            'busiId' => '商家ID',
            'storeName' => '店铺名称',
            'storeId' => '店铺ID',
            'applyTime' => '申请时间',
            'refundMoney' => '退款金额',
            'refundReason' => '退款原因',
            'verificationCode' => '验证码',
            'userName' => '用户名称',
            'userAccount' => '用户账号',
        ];
    }

    public function getRefundReviews($fromDate, $toDate)
    {
        $query = $this::find();
        $id = 1;
        $query->andWhere(['busiId' => $id]);
        $query->andFilterWhere(['BETWEEN', 'applyTime', $fromDate, $toDate]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}
