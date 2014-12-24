<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComMessageBox;

/**
 * ComMessageBoxSearch represents the model behind the search form about `backend\models\ComMessageBox`.
 */
class ComMessageBoxSearch extends ComMessageBox
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'recipientsId'], 'integer'],
            [['seeDate', 'sendOutDate', 'recipientsName', 'readState', 'summary', 'content', 'title'], 'safe'],
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
        $query = ComMessageBox::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'seeDate' => $this->seeDate,
            'sendOutDate' => $this->sendOutDate,
            'recipientsId' => $this->recipientsId,
        ]);

        $query->andFilterWhere(['like', 'recipientsName', $this->recipientsName])
            ->andFilterWhere(['like', 'readState', $this->readState])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
