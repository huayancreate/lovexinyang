<?php

namespace backend\controllers;

use Yii;
use backend\models\CusVerificationCode;
use backend\models\CusVerificationCodeSearch;
use backend\models\CusOrderDetailsSearch;
use backend\models\CusOrderDetails;
use backend\models\CusConsumptionRecords;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * CusVerificationCodeController implements the CRUD actions for CusVerificationCode model.
 */
class CusVerificationCodeController extends BackendController
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
     * Lists all CusVerificationCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CusVerificationCodeSearch();
       
        $verificationCodeModel=$searchModel->searchModel(Yii::$app->request->queryParams);

        //获取订单详情 
        $orderDetails=new CusOrderDetails();
        if($verificationCodeModel!=null){
            $orderDetails=$this->getOrderDetails($verificationCodeModel->orderDetailsId);
        }
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'orderDetailsModel'=>$orderDetails==null?new CusOrderDetails():$orderDetails,
            'dataProvider' => $this->getConsumptionRecords(),
        ]);
    }

    /**
     * 获取订单详情
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    protected function getOrderDetails($id){
        return CusOrderDetails::find()->where(['id'=>$id])->one();
    }

    /**
     * 获取消费记录
     * @return [type] [description]
     */
    protected function getConsumptionRecords(){

        $query = CusConsumptionRecords::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andFilterWhere(['flag'=>'1']);

        return $dataProvider;
    }

    public function actionConsumption(){
        
        $model = new CusVerificationCodeSearch();

        if ($model->load(Yii::$app->request->post())){
           $orderDetails = $this->getOrderDetails($model->orderDetailsId);

           $consumption=new CusConsumptionRecords();
           $consumption->orderId=$orderDetails->orderId; //订单ID
           $consumption->goodsId=$orderDetails->goodsId; //商品ID
           
        }
    }

    /**
     * 新增消费记录
     * @return [type] [description]
     */
    protected function insertConsumptionRecords($model){

    }

    /**
     * Displays a single CusVerificationCode model.
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
     * Creates a new CusVerificationCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CusVerificationCode();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CusVerificationCode model.
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
     * Deletes an existing CusVerificationCode model.
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
     * Finds the CusVerificationCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CusVerificationCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CusVerificationCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
