<?php

namespace backend\controllers;

use Yii;
use backend\models\StoStoreInfo;
use backend\models\ShopInfoReview;
use backend\models\ComCategoryMaintain;
use backend\models\StoApplyInfo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * StostoreinfoController implements the CRUD actions for StoStoreInfo model.
 */
class StostoreinfoController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all StoStoreInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StoStoreInfo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'shoInforeViewData'=>$this->getShopInforeViewData(),
            //'stoApplyInfoModel'=>$this->getApplyInfo(),
        ]);
    }

    protected function getApplyInfo($id=1){
        return StoApplyInfo::findOne($id);
    }

    /**
     * [getShopInforeViewData description]
     * 获取门店审核信息
     * @return [type] [description]
     */
    protected function getShopInforeViewData(){
        $dataProvider = new ActiveDataProvider([
            'query' => ShopInfoReview::find(),
            'pagination' => ['pagesize' => '4'],
        ]);
        return $dataProvider;
    }

    /**
     * Displays a single StoStoreInfo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoStoreInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoStoreInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StoStoreInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

            $message=shopInfoReviewSave($model); //插入店铺申请表
            return json_encode($message);

            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $categoryModel=new ComCategoryMaintain();
            $categoryList =ComCategoryMaintain::find()->where(['categoryType'=>1])->all();

            return $this->renderPartial('update', [
                'model' => $model,'categoryModel'=>$categoryModel,'categoryList'=>$categoryList
            ]);
        }
    }

    /**
     * [shopInfoReviewSave 店铺申请保存]
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    protected function shopInfoReviewSave($model){
        $shopInfo=new ShopInfoReview();
        $shopInfo->longitude=$model->longitude;  //经度
        $shopInfo->latitude=$model->latitude;   //纬度
        $shopInfo->shopName=$model->storeName;  //店铺名称
        $shopInfo->contact=$model->contactWay;//联系方式
        $shopInfo->storeId=$model->sellerId; //商家ID
        $shopInfo->address=$model->storeAddress; //地址
        $shopInfo->businessHours=$model->businessHours;// 营业时间
        $shopInfo->businessDistrictId=$model->businessDistrictId; //商圈ID
        $shopInfo->cityId=$model->cityId;//城市ID
        $shopInfo->countyId=$model->countryID; //区县ID
        $shopInfo->storeOutline=$model->storeOutline;//门店概述
        $shopInfo->applyTime=date("Y-m-d H:i:s"); //申请时间
        $shopInfo->applyUserId=1; //申请人ID
        $shopInfo->applyUserName="申请人-张三";
        $shopInfo->auditState=1;

        $shopInfo->save();

        $message=$shopInfo->getErrors();
        $message["success"]=True;

        return $message;
    }

    /**
     * Deletes an existing StoStoreInfo model.
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
     * Finds the StoStoreInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoStoreInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoStoreInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
