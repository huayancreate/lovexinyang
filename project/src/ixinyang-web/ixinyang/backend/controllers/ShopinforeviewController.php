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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

                //城市
                $cityModel=new ComCitycenter();
                $cityList=ComCitycenter::find()->all();
                //区县
                $countyModel=new ComCounty();
                $countyList=ComCounty::find()->all();
                //商圈
                $busidistModel=new ComBusinessDistrict();
                $busidistList=ComBusinessDistrict::find()->all();


            return $this->render('create', [
                'model' => $model,'cityModel'=>$cityModel,'cityList'=>$cityList,
                'countyList'=>$countyList,'countyModel'=>$countyModel,
                'busidistList'=>$busidistList,'busidistModel'=>$busidistModel,
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
    public function getBusinessDistrict($countyId){
        $business=ComBusinessDistrict::find()->where(['countyId' =>$countryId,'isValid'=>1])->asArray()->all();
        return json_encode($business) ;
    }

    /**
     * [getCounty description]
     * 根据市区ID 获取县
     * @param  [type] $cityCenterId [市区ID]
     * @return [type]               [description]
     */
    public function getCounty($cityCenterId){
       $countrys=ComCounty::find()->where(['cityCenterId' =>$cityCenterId,'isValid'=>1])->asArray()->all();
        return json_encode($countrys) ;
    }
}
