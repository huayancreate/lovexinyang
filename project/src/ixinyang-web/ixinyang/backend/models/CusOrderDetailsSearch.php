<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CusOrderDetails;

/**
 * CusOrderDetailsSearch represents the model behind the search form about `backend\models\CusOrderDetails`.
 */
class CusOrderDetailsSearch extends CusOrderDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orderId', 'goodsId', 'totalNum', 'sellerId', 'shopId', 'CodeStatus'], 'integer'],
            [['goodsName', 'rebate', 'memberCardNo', 'shopName', 'validateCode', 'validateCodeHash'], 'safe'],
            [['price', 'totalPrice', 'rebatePrice'], 'number'],
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
     * 根据验证码、商家ID,获取待消费订单信息
     * @param  [type] $params   [description]
     * @param  [type] $sellerId [description]
     * @return [type]           [description]
     */
    public function search($params,$sellerId){
        $query = CusOrderDetails::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {

            // $query->andFilterWhere([
            //     'validateCodeHash'=>'null',
            // ]);

            return $dataProvider;
        }

        $cardNo=CusOrderDetails::find()->where(['validateCodeHash'=>md5($this->validateCode)])->one();

        $query->andFilterWhere([
            'sellerId' => $sellerId,
            'CodeStatus'=>1,
            'memberCardNo'=>$cardNo!=null ? $cardNo->memberCardNo : 'null',
        ]);
        return $dataProvider;

    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    // public function search($params)
    // {
    //     $query = CusOrderDetails::find();

    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //     ]);

    //     if (!($this->load($params) && $this->validate())) {
    //         return $dataProvider;
    //     }

    //     $query->andFilterWhere([
    //         'id' => $this->id,
    //         'orderId' => $this->orderId,
    //         'goodsId' => $this->goodsId,
    //         'price' => $this->price,
    //         'totalPrice' => $this->totalPrice,
    //         'rebatePrice' => $this->rebatePrice,
    //         'totalNum' => $this->totalNum,
    //         'sellerId' => $this->sellerId,
    //         'shopId' => $this->shopId,
    //         'CodeStatus' => $this->CodeStatus,
    //     ]);

    //     $query->andFilterWhere(['like', 'goodsName', $this->goodsName])
    //         ->andFilterWhere(['like', 'rebate', $this->rebate])
    //         ->andFilterWhere(['like', 'memberCardNo', $this->memberCardNo])
    //         ->andFilterWhere(['like', 'shopName', $this->shopName])
    //         ->andFilterWhere(['like', 'validateCode', $this->validateCode])
    //         ->andFilterWhere(['like', 'validateCodeHash', $this->validateCodeHash]);

    //     return $dataProvider;
    // }
}
