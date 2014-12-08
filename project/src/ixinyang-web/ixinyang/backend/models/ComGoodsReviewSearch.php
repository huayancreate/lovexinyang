<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComGoodsReview;

/**
 * ComGoodsReviewSearch represents the model behind the search form about `backend\models\ComGoodsReview`.
 */
class ComGoodsReviewSearch extends ComGoodsReview
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cgrId', 'goodsId', 'applyerId', 'reviewerId', 'reviewTaskId', 'reviewStatus'], 'integer'],
            [['goodsName', 'applyerAccount', 'applyTime', 'reviewerName', 'reviewTime', 'remark'], 'safe'],
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
        $query = ComGoodsReview::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cgrId' => $this->cgrId,
            'goodsId' => $this->goodsId,
            'applyerId' => $this->applyerId,
            'applyTime' => $this->applyTime,
            'reviewerId' => $this->reviewerId,
            'reviewTaskId' => $this->reviewTaskId,
            'reviewTime' => $this->reviewTime,
            'reviewStatus' => $this->reviewStatus,
        ]);

        $query->andFilterWhere(['like', 'goodsName', $this->goodsName])
            ->andFilterWhere(['like', 'applyerAccount', $this->applyerAccount])
            ->andFilterWhere(['like', 'reviewerName', $this->reviewerName])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
