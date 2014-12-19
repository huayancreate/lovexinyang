<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ComRefundStream;

/**
 * ComRefundStreamSearch represents the model behind the search form about `backend\models\ComRefundStream`.
 */
class ComRefundStreamSearch extends ComRefundStream
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'operatorId', 'refundStreamId', 'refundApplyId', 'userId', 'alipayStreamNumber'], 'integer'],
            [['operatorAccount', 'operateTime', 'loadTime', 'loadAlipayName', 'loadAlipayAccount', 'refundTime', 'refundApplyTime', 'verificationCode', 'userAccount', 'payAlipayName', 'payAlipayAccount'], 'safe'],
            [['refundMoney'], 'number'],
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
        $query = ComRefundStream::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'operatorId' => $this->operatorId,
            'operateTime' => $this->operateTime,
            'loadTime' => $this->loadTime,
            'refundMoney' => $this->refundMoney,
            'refundStreamId' => $this->refundStreamId,
            'refundTime' => $this->refundTime,
            'refundApplyId' => $this->refundApplyId,
            'refundApplyTime' => $this->refundApplyTime,
            'userId' => $this->userId,
            'alipayStreamNumber' => $this->alipayStreamNumber,
        ]);

        $query->andFilterWhere(['like', 'operatorAccount', $this->operatorAccount])
            ->andFilterWhere(['like', 'loadAlipayName', $this->loadAlipayName])
            ->andFilterWhere(['like', 'loadAlipayAccount', $this->loadAlipayAccount])
            ->andFilterWhere(['like', 'verificationCode', $this->verificationCode])
            ->andFilterWhere(['like', 'userAccount', $this->userAccount])
            ->andFilterWhere(['like', 'payAlipayName', $this->payAlipayName])
            ->andFilterWhere(['like', 'payAlipayAccount', $this->payAlipayAccount]);

        return $dataProvider;
    }
}
