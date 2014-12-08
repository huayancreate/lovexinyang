<?php

namespace backend\controllers;

use Yii;
use backend\models\ShopInfoReview;
use backend\models\ComBusinessDistrict;
use backend\models\ComCitycenter;
use backend\models\ComCounty;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * ShopinforeviewController implements the CRUD actions for ShopInfoReview model.
 */
class ShopinforeviewController extends Controller
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
     * Lists all ShopInfoReview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ShopInfoReview::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopInfoReview model.
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
     * Creates a new ShopInfoReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopInfoReview();


        if ($model->load(Yii::$app->request->post())) {

            $transaction=\Yii::$app->db->beginTransaction(); 
            try{

                $model->storeAccount="storeAdmin"; //商家账号
                $model->applyTime=date("Y-m-d H:i:s");//申请时间
                $model->applyUserId="1";//申请人ID
                $model->applyUserName="张三";//申请人姓名
                $model->auditState="1"; //申请状态  1、申请中 2、初审通过 3、初审驳回 4、经理审核通过  5、经理审核驳回
                
                $model->save();

                $transaction->commit(); //事务结束

                $message=$model->getErrors();
                $message["success"]=True;

                return json_encode($message);
                
                //return $this->redirect(['view', 'id' => $model->id]);

            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }

        } else {
            //城市
            $cityModel=new ComCitycenter();
            $cityList=ComCitycenter::find()->all();

            return $this->renderPartial('create', [
                'model' => $model,'cityModel'=>$cityModel,'cityList'=>$cityList
            ]);
        }
    }

    /**
     * Updates an existing ShopInfoReview model.
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
     * Deletes an existing ShopInfoReview model.
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
     * Finds the ShopInfoReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopInfoReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopInfoReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * [getCitycenter 获取所有城市信息]
     * @return [type] [description]
     */
    protected function getCitycenter(){
        $city=ComCitycenter::find()->all();
        return $city;
    }

    /** 
     * [getBusinessDistrict 根据区县ID 获取商圈]
     * @param  [type] $countyId [区县ID]
     * @return [type]           [description]
     */
    public function actionBusiness($countyId){
        $business=ComBusinessDistrict::find()->where(['countyId' =>$countyId,'isValid'=>1])->asArray()->all();
        return json_encode($business) ;
    }

    /**
     * [getCounty description]
     * 根据市区ID 获q区县
     * @param  [type] $cityCenterId [市区ID]
     * @return [type]               [description]
     */
    public function actionCounty($cityId){
        $countrys=ComCounty::find()->where(['cityCenterId' =>$cityId,'isValid'=>1])->asArray()->all();
        return json_encode($countrys) ;
    }
}
