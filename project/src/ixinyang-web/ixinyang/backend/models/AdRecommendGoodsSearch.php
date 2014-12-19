<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AdRecommendGoods;

/**
 * AdRecommendGoodsSearch represents the model behind the search form about `backend\models\AdRecommendGoods`.
 */
class AdRecommendGoodsSearch extends AdRecommendGoods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'adLocation', 'ad_recommend_goods', 'ad_advertisement', 'order'], 'integer'],
            [['creater', 'createTime', 'endDate', 'startDate', 'isValid'], 'safe'],
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
        $query = AdRecommendGoods::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'createTime' => $this->createTime,
            'adLocation' => $this->adLocation,
            'endDate' => $this->endDate,
            'startDate' => $this->startDate,
            'ad_recommend_goods' => $this->ad_recommend_goods,
            'ad_advertisement' => $this->ad_advertisement,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'creater', $this->creater])
            ->andFilterWhere(['like', 'isValid', $this->isValid]);

        return $dataProvider;
    }
}
