<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AdPushMessage;

/**
 * AdPushMessageSearch represents the model behind the search form about `backend\models\AdPushMessage`.
 */
class AdPushMessageSearch extends AdPushMessage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'toAge', 'fromAge', 'membershipGrade'], 'integer'],
            [['area', 'isValid', 'pushIntroduction', 'pushTime', 'pushDetails', 'pushSex', 'messageTopic'], 'safe'],
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
        $query = AdPushMessage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'toAge' => $this->toAge,
            'fromAge' => $this->fromAge,
            'pushTime' => $this->pushTime,
            'membershipGrade' => $this->membershipGrade,
        ]);

        $query->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'isValid', $this->isValid])
            ->andFilterWhere(['like', 'pushIntroduction', $this->pushIntroduction])
            ->andFilterWhere(['like', 'pushDetails', $this->pushDetails])
            ->andFilterWhere(['like', 'pushSex', $this->pushSex])
            ->andFilterWhere(['like', 'messageTopic', $this->messageTopic]);

        return $dataProvider;
    }
}
