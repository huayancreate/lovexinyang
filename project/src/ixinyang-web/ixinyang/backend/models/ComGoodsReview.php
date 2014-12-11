<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;

/**
 * This is the model class for table "com_goods_review".
 *
 * @property integer $cgrId
 * @property integer $goodsId
 * @property string $goodsName
 * @property integer $applyerId
 * @property string $applyerAccount
 * @property string $applyTime
 * @property integer $reviewerId
 * @property string $reviewerName
 * @property integer $reviewTaskId
 * @property string $reviewTime
 * @property integer $reviewStatus
 * @property string $remark
 */
class ComGoodsReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'com_goods_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodsId', 'applyerId', 'reviewerId', 'reviewTaskId', 'reviewStatus'], 'integer'],
            [['applyTime', 'reviewTime'], 'safe'],
            [['goodsName'], 'string', 'max' => 300],
            [['applyerAccount', 'reviewerName'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cgrId' => 'Cgr ID',
            'goodsId' => 'Goods ID',
            'goodsName' => 'Goods Name',
            'applyerId' => 'Applyer ID',
            'applyerAccount' => 'Applyer Account',
            'applyTime' => 'Apply Time',
            'reviewerId' => 'Reviewer ID',
            'reviewerName' => 'Reviewer Name',
            'reviewTaskId' => 'Review Task ID',
            'reviewTime' => 'Review Time',
            'reviewStatus' => 'Review Status',
            'remark' => 'Remark',
        ];
    }

    public function getAllGoodS($startDate, $endDate)
    {
        $query = $this::find();
        $query->andWhere(['reviewStatus' => '0']);
        $query->andFilterWhere(['BETWEEN', 'applyTime', $startDate, $endDate]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }


    /**
     * 审核操作
     * @param $id
     * @param $status
     * @throws Exception
     */
    public function verifyGoods($id, $status)
    {
        //事务开始
        $transaction = $this->getDb()->beginTransaction();
        try {
            //1.更新com_goods_review
            $this->updateGoodsVerify($status);
            //2.添加数据到sto_goods
            $this->saveFinalGoods($id);
            $transaction->commit();
        } catch (Exception $ex) {
            $transaction->rollBack();
        }

    }

    /**
     * 更新审核状态
     * @param $status
     */
    public function updateGoodsVerify($status)
    {
        $this->reviewStatus = $status;
        $this->reviewTime = date("Y-m-d H:i:s");
        $this->save();
    }

    /**
     * 保存最终的商品信息
     * @param $id
     */
    public function saveFinalGoods($id)
    {
        $model = new StoGoods();
        $goodApplyInfo = GoodsApplyInfo::findOne($id);
        $model->goodsName = $goodApplyInfo->goodsName;
        $model->summary = $goodApplyInfo->goodsIntroduction;
        $model->describes = $goodApplyInfo->goodsDescription;
        $model->price = $goodApplyInfo->goodsPrice;
        $model->subClass = $goodApplyInfo->goodsType;
        $model->validity = "1";
        $model->supplyDateTime = $goodApplyInfo->supplyTime;
        $model->enjoyRebate = $goodApplyInfo->memberDiscount;
        $model->goodsGrade = "0";
        $model->goodsWeight = "0";
        $model->goodsState = "0";
        $model->createDate = date("Y-m-d H:i:s");
        $model->createID = "1";
        $model->createName = "admin";
        $model->save();
    }

}
