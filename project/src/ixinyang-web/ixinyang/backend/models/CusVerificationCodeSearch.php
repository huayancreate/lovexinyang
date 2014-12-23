<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CusVerificationCode;

/**
 * CusVerificationCodeSearch represents the model behind the search form about `backend\models\CusVerificationCode`.
 */
class CusVerificationCodeSearch extends CusVerificationCode
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orderDetailsId', 'goodsId', 'number'], 'integer'],
            [['verificationCode', 'orderNo', 'state'], 'safe'],
            [['costPrice', 'payablePrice'], 'number'],
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
        $query = CusVerificationCode::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'orderDetailsId' => $this->orderDetailsId,
            'goodsId' => $this->goodsId,
            'number' => $this->number,
            'costPrice' => $this->costPrice,
            'payablePrice' => $this->payablePrice,
        ]);

        $query->andFilterWhere(['like', 'verificationCode', $this->verificationCode])
            ->andFilterWhere(['like', 'orderNo', $this->orderNo])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
    
    /**
     * 查询单个Model
     */
    public function searchModel($params){
        
        $model=new CusVerificationCode();
        if (!($this->load($params) && $this->validate())) {
           return $model;
        }
        $model=$model::find()->where(['verificationCode'=>$this->verificationCode])->one();
       return $model;
    }
}
