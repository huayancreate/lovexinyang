<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CusOrderDetails;

/**
 * CusOrderDetailsSearch represents the model behind the search form about `backend\models\CusOrderDetails`.
 */
class CusOrderDetailsSearch extends CusOrderDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orderId', 'goodsId', 'totalNum', 'sellerId'], 'integer'],
            [['goodsName', 'rebate', 'memberCardNo'], 'safe'],
            [['price', 'totalPrice', 'rebatePrice'], 'number'],
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
        $query = CusOrderDetails::find();

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
            'price' => $this->price,
            'totalPrice' => $this->totalPrice,
            'rebatePrice' => $this->rebatePrice,
            'totalNum' => $this->totalNum,
            'sellerId' => $this->sellerId,
        ]);

        $query->andFilterWhere(['like', 'goodsName', $this->goodsName])
            ->andFilterWhere(['like', 'rebate', $this->rebate])
            ->andFilterWhere(['like', 'memberCardNo', $this->memberCardNo]);

        return $dataProvider;
    }
}
