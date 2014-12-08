<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StoGoods;

/**
 * StoGoodsSearch represents the model behind the search form about `backend\models\StoGoods`.
 */
class StoGoodsSearch extends StoGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'goodsGrade', 'goodsWeight', 'goodsState', 'createID'], 'integer'],
            [['goodsName', 'summary', 'describes', 'subClass', 'validity', 'supplyDateTime', 'enjoyRebate', 'createDate', 'createName'], 'safe'],
            [['price'], 'number'],
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
        $query = StoGoods::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
            'supplyDateTime' => $this->supplyDateTime,
            'goodsGrade' => $this->goodsGrade,
            'goodsWeight' => $this->goodsWeight,
            'goodsState' => $this->goodsState,
            'createDate' => $this->createDate,
            'createID' => $this->createID,
        ]);

        $query->andFilterWhere(['like', 'goodsName', $this->goodsName])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'describes', $this->describes])
            ->andFilterWhere(['like', 'subClass', $this->subClass])
            ->andFilterWhere(['like', 'validity', $this->validity])
            ->andFilterWhere(['like', 'enjoyRebate', $this->enjoyRebate])
            ->andFilterWhere(['like', 'createName', $this->createName]);

        return $dataProvider;
    }
}
