<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Ad;

/**
 * AdSearch represents the model behind the search form about `backend\models\Ad`.
 */
class AdSearch extends Ad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'createrId', 'mapOrder', 'mapLocation'], 'integer'],
            [['createTime', 'mapLink', 'updateTime', 'adName', 'endDate', 'startDate', 'isValid', 'photoUrl'], 'safe'],
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
        $query = Ad::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'createrId' => $this->createrId,
            'createTime' => $this->createTime,
            'mapOrder' => $this->mapOrder,
            'mapLocation' => $this->mapLocation,
            'updateTime' => $this->updateTime,
            'endDate' => $this->endDate,
            'startDate' => $this->startDate,
        ]);

        $query->andFilterWhere(['like', 'mapLink', $this->mapLink])
            ->andFilterWhere(['like', 'adName', $this->adName])
            ->andFilterWhere(['like', 'isValid', $this->isValid])
            ->andFilterWhere(['like', 'photoUrl', $this->photoUrl]);

        return $dataProvider;
    }
}
