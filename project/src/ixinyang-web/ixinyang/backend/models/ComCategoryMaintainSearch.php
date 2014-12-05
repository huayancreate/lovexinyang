<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComCategoryMaintain;

/**
 * ComCategoryMaintainSearch represents the model behind the search form about `backend\models\ComCategoryMaintain`.
 */
class ComCategoryMaintainSearch extends ComCategoryMaintain
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parentCategoryId', 'categoryCode', 'categoryGrade', 'categoryType', 'operatorId', 'sort'], 'integer'],
            [['categoryAttribute', 'categoryFeature', 'categoryName', 'operatorName', 'updateTime', 'isValid'], 'safe'],
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
        $query = ComCategoryMaintain::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '5']
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parentCategoryId' => $this->parentCategoryId,
            'categoryCode' => $this->categoryCode,
            'categoryGrade' => $this->categoryGrade,
            'categoryType' => $this->categoryType,
            'operatorId' => $this->operatorId,
            'updateTime' => $this->updateTime,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'categoryAttribute', $this->categoryAttribute])
            ->andFilterWhere(['like', 'categoryFeature', $this->categoryFeature])
            ->andFilterWhere(['like', 'categoryName', $this->categoryName])
            ->andFilterWhere(['like', 'operatorName', $this->operatorName])
            ->andFilterWhere(['like', 'isValid', $this->isValid]);

        return $dataProvider;
    }
}
