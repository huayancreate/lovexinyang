<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\GoodsApplyInfo;

/**
 * GoodsApplyInfoSearch represents the model behind the search form about `backend\models\GoodsApplyInfo`.
 */
class GoodsApplyInfoSearch extends GoodsApplyInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shopId', 'stock', 'enterId', 'storeId', 'goodsType', 'goodsId', 'goodsStatus'], 'integer'],
            [['shopName', 'enterAccount', 'storeName', 'supplyTime', 'goodsIntroduction', 'goodsDescription', 'goodsName', 'goodsValidityDate', 'memberDiscount'], 'safe'],
            [['goodsPrice'], 'number'],
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
        $query = GoodsApplyInfo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'shopId' => $this->shopId,
            'stock' => $this->stock,
            'enterId' => $this->enterId,
            'storeId' => $this->storeId,
            'supplyTime' => $this->supplyTime,
            'goodsPrice' => $this->goodsPrice,
            'goodsType' => $this->goodsType,
            'goodsValidityDate' => $this->goodsValidityDate,
            'goodsId' => $this->goodsId,
            'goodsStatus' => $this->goodsStatus,
        ]);

        $query->andFilterWhere(['like', 'shopName', $this->shopName])
            ->andFilterWhere(['like', 'enterAccount', $this->enterAccount])
            ->andFilterWhere(['like', 'storeName', $this->storeName])
            ->andFilterWhere(['like', 'goodsIntroduction', $this->goodsIntroduction])
            ->andFilterWhere(['like', 'goodsDescription', $this->goodsDescription])
            ->andFilterWhere(['like', 'goodsName', $this->goodsName])
            ->andFilterWhere(['like', 'memberDiscount', $this->memberDiscount]);

        return $dataProvider;
    }
}
