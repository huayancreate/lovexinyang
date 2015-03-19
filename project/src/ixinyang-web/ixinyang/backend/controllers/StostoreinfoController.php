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
class StostoreinfoController extends BackendController
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
     * Lists all StoStoreInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StoStoreInfo::find(),
            'pagination' => ['pagesize' => '5'],
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
            'query' => ShopInfoReview::find()->where('auditState!=4 and auditState!=2')->asArray(),
            'pagination' => ['pagesize' => '5'],
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
        $model->scenario ='update';

        if ($model->load(Yii::$app->request->post())) {

            $model->save();

            /*$message=$model->getErrors();
            $message["success"]=True;

            return json_encode($message);*/

            return $this->redirect(['stostoreinfo/index']);

        } else {
            $categoryModel=new ComCategoryMaintain();
            $categoryList =ComCategoryMaintain::find()->where(['categoryType'=>1])->all();
            //获取商品类别
            $category = $categoryModel->getCategoryByParentId($model->storeType);
            if ($category == null) {
                $category = new ComCategoryMaintain();
                $category->categoryName = '';
            }

            return $this->renderAjax('update', [
                'model' => $model,'categoryModel'=>$categoryModel,'categoryList'=>$categoryList,
                'category'=>$category
            ]);
        }
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
