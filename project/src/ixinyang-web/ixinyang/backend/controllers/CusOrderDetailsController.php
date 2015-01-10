<?php

namespace backend\controllers;

use Yii;
use backend\models\CusOrderDetails;
use backend\models\CusOrderDetailsSearch;
use backend\models\CusConsumptionRecords;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CusorderdetailsController implements the CRUD actions for CusOrderDetails model.
 */
class CusorderdetailsController extends BackendController
{
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all CusOrderDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CusOrderDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1); // search('Ìá½»²ÎÊý',ÉÌ¼ÒID)

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CusOrderDetails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CusOrderDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CusOrderDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CusOrderDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CusOrderDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 确认消费，新增消费记录并增加会员积分
     * @return [type] [description]
     */
    public function actionConsumption(){
        
        $transaction=\Yii::$app->db->beginTransaction();

        try{
            $keys=$_POST["keys"];  //获取订单明细ID
            foreach ($keys as $key) {
                $model=$this->findModel($key);  //获取订单明细

                $this->consumptionModel($model)->save(); //新增消费流水

                $model->CodeStatus=2;
                $model->save(); //修改订单状态
                //print_r($model);
            }

            $transaction->commit();

        } catch (Exception $e) {

            $transaction->rollback();

            return "非法操作";
        }
        return $this->redirect(['index']);
    }


    /**
     * Finds the CusOrderDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CusOrderDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CusOrderDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function consumptionModel($item){
        $sumption=new CusConsumptionRecords();
        $sumption->orderId=$item->orderId;  //订单ID
        $sumption->goodsId=$item->goodsId;  //商品ID
        $sumption->verfificationCode=$item->validateCode; //验证码
        $sumption->goodsNumber=$item->totalNum; //商品数量
        $sumption->costPrice=$item->price; //商品价格
        $sumption->payablePrice=$item->rebatePrice; //实付价格
        $sumption->rebate=$item->rebate; //折扣
        $sumption->memberCardNo=$item->memberCardNo; //会员卡号
        $sumption->shopId=$item->shopId; //商家ID
        $sumption->shopName=$item->shopName; //商家名称
        $sumption->verifierAccount="verifier-Admin";  //验证人
        $sumption->verifierTime=date("Y-m-d H:i:s"); //验证时间
        $sumption->flag="0"; // 0：平台消费 /  1:现金消费
        
        return $sumption;
    }
}
