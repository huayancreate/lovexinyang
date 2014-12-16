<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComRefundReview;

/**
 * ComRefundReviewSearch represents the model behind the search form about `backend\models\ComRefundReview`.
 */
class ComRefundReviewSearch extends ComRefundReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'financeId', 'financeReviewStatus', 'reviewId', 'reviewStatus', 'orderId', 'busiId', 'storeId'], 'integer'],
            [['financeAccount', 'financeReviewTime', 'reviewAccount', 'reviewTime', 'orderName', 'busiName', 'storeName', 'applyTime', 'refundReason', 'verificationCode', 'userName', 'userAccount'], 'safe'],
            [['refundMoney'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ComRefundReview::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'financeId' => $this->financeId,
            'financeReviewTime' => $this->financeReviewTime,
            'financeReviewStatus' => $this->financeReviewStatus,
            'reviewId' => $this->reviewId,
            'reviewTime' => $this->reviewTime,
            'reviewStatus' => $this->reviewStatus,
            'orderId' => $this->orderId,
            'busiId' => $this->busiId,
            'storeId' => $this->storeId,
            'applyTime' => $this->applyTime,
            'refundMoney' => $this->refundMoney,
        ]);

        $query->andFilterWhere(['like', 'financeAccount', $this->financeAccount])
            ->andFilterWhere(['like', 'reviewAccount', $this->reviewAccount])
            ->andFilterWhere(['like', 'orderName', $this->orderName])
            ->andFilterWhere(['like', 'busiName', $this->busiName])
            ->andFilterWhere(['like', 'storeName', $this->storeName])
            ->andFilterWhere(['like', 'refundReason', $this->refundReason])
            ->andFilterWhere(['like', 'verificationCode', $this->verificationCode])
            ->andFilterWhere(['like', 'userName', $this->userName])
            ->andFilterWhere(['like', 'userAccount', $this->userAccount]);

        return $dataProvider;
    }
}
