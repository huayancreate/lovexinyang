<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StoBalanceReview;

/**
 * StoBalanceReviewSearch represents the model behind the search form about `backend\models\StoBalanceReview`.
 */
class StoBalanceReviewSearch extends StoBalanceReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'financeId', 'financeReviewStatus', 'reviewId', 'reviewStatus', 'storeId', 'applyerId'], 'integer'],
            [['financeAccount', 'reviewAccount', 'reviewTime', 'serviceAgreement', 'balanceEndTime', 'balanceStartTime', 'storeName', 'applyerAccount', 'financeReviewTime'], 'safe'],
            [['serviceFee', 'applyMoney', 'actualBalanceMoney'], 'number'],
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
        $query = StoBalanceReview::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '10']
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'financeId' => $this->financeId,
            'financeReviewStatus' => $this->financeReviewStatus,
            'reviewId' => $this->reviewId,
            'reviewTime' => $this->reviewTime,
            'reviewStatus' => $this->reviewStatus,
            'serviceFee' => $this->serviceFee,
            'balanceEndTime' => $this->balanceEndTime,
            'balanceStartTime' => $this->balanceStartTime,
            'storeId' => $this->storeId,
            'applyerId' => $this->applyerId,
            'applyMoney' => $this->applyMoney,
            'actualBalanceMoney' => $this->actualBalanceMoney,
            'financeReviewTime' => $this->financeReviewTime,
        ]);

        $query->andFilterWhere(['like', 'financeAccount', $this->financeAccount])
            ->andFilterWhere(['like', 'reviewAccount', $this->reviewAccount])
            ->andFilterWhere(['like', 'serviceAgreement', $this->serviceAgreement])
            ->andFilterWhere(['like', 'storeName', $this->storeName])
            ->andFilterWhere(['like', 'applyerAccount', $this->applyerAccount]);

        return $dataProvider;
    }
}
