<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComAccount;

/**
 * ComAccountSearch represents the model behind the search form about `backend\models\ComAccount`.
 */
class ComAccountSearch extends ComAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'accountStatus'], 'integer'],
            [['email', 'createTime', 'phoneNumber', 'updateTime', 'password', 'sex', 'nickname', 'userName', 'address', 'isFirstLogin'], 'safe'],
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
        $query = ComAccount::find()->where('accountStatus=1')->asArray();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' => '10']
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'createTime' => $this->createTime,
            'updateTime' => $this->updateTime,
            'accountStatus' => $this->accountStatus,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'userName', $this->userName])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'isFirstLogin', $this->isFirstLogin]);

        return $dataProvider;
    }
}
