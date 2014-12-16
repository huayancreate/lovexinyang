<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CusConsumptionRecords;

/**
 * CusConsumptionRecordsSearch represents the model behind the search form about `backend\models\CusConsumptionRecords`.
 */
class CusConsumptionRecordsSearch extends CusConsumptionRecords
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orderId', 'goodsId', 'goodsNumber', 'sellerId'], 'integer'],
            [['orderNo', 'verfificationCode', 'rebate', 'userAccount', 'memberCardNo', 'sellerAccount', 'verifierAccount', 'verifierTime'], 'safe'],
            [['costPrice', 'payablePrice'], 'number'],
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
        $query = CusConsumptionRecords::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'orderId' => $this->orderId,
            'goodsId' => $this->goodsId,
            'goodsNumber' => $this->goodsNumber,
            'costPrice' => $this->costPrice,
            'payablePrice' => $this->payablePrice,
            'sellerId' => $this->sellerId,
            'verifierTime' => $this->verifierTime,
        ]);

        $query->andFilterWhere(['like', 'orderNo', $this->orderNo])
            ->andFilterWhere(['like', 'verfificationCode', $this->verfificationCode])
            ->andFilterWhere(['like', 'rebate', $this->rebate])
            ->andFilterWhere(['like', 'userAccount', $this->userAccount])
            ->andFilterWhere(['like', 'memberCardNo', $this->memberCardNo])
            ->andFilterWhere(['like', 'sellerAccount', $this->sellerAccount])
            ->andFilterWhere(['like', 'verifierAccount', $this->verifierAccount]);

        return $dataProvider;
    }
}
