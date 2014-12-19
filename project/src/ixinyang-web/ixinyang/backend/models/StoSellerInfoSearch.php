<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\StoSellerInfo;

/**
 * StoSellerInfoSearch represents the model behind the search form about `backend\models\StoSellerInfo`.
 */
class StoSellerInfoSearch extends StoSellerInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contractId'], 'integer'],
            [['customerManager', 'otherContactWay', 'summary', 'sellerName', 'sellerdetails', 'validity', 'contacts', 'phone', 'email'], 'safe'],
            [['accountBalance'], 'number'],
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
        $query = StoSellerInfo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'contractId' => $this->contractId,
            'accountBalance' => $this->accountBalance,
        ]);

        $query->andFilterWhere(['like', 'customerManager', $this->customerManager])
            ->andFilterWhere(['like', 'otherContactWay', $this->otherContactWay])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'sellerName', $this->sellerName])
            ->andFilterWhere(['like', 'sellerdetails', $this->sellerdetails])
            ->andFilterWhere(['like', 'validity', $this->validity])
            ->andFilterWhere(['like', 'contacts', $this->contacts])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
