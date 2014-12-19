<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CusOrder;

/**
 * CusOrderSearch represents the model behind the search form about `backend\models\CusOrder`.
 */
class CusOrderSearch extends CusOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orderNo'], 'integer'],
            [['totalPrice', 'payTotalPrice'], 'number'],
            [['userAccount', 'userName', 'buyTime', 'methodsPayment', 'paymentAccount'], 'safe'],
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
        $query = CusOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'orderNo' => $this->orderNo,
            'totalPrice' => $this->totalPrice,
            'payTotalPrice' => $this->payTotalPrice,
            'buyTime' => $this->buyTime,
        ]);

        $query->andFilterWhere(['like', 'userAccount', $this->userAccount])
            ->andFilterWhere(['like', 'userName', $this->userName])
            ->andFilterWhere(['like', 'methodsPayment', $this->methodsPayment])
            ->andFilterWhere(['like', 'paymentAccount', $this->paymentAccount]);

        return $dataProvider;
    }
}
