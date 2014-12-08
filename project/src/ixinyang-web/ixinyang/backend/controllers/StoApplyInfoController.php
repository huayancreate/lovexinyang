<?php

namespace backend\controllers;

use Yii;
use backend\models\StoApplyInfo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ComCitycenter;
use backend\models\ComCounty;
use backend\models\ComBusinessDistrict;
use backend\models\ComCategoryMaintain;
use yii\data\Pagination;

/*
 * StoApplyInfoController implements the CRUD actions for StoApplyInfo model.
 */
class StoApplyInfoController extends Controller
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
  

    public function actionMap()
    {       
        return $this->render('map');
    }

    /**
     * Creates a new StoApplyInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoApplyInfo();
        $citys = ComCitycenter::find()->all();

        if ($model->load(Yii::$app->request->post())) {
       date_default_timezone_set('PRC');
       $model->applyTime=date("Y-m-d H:i:s");
       $model->applyStatus=0;
           $model->save();
            return $this->redirect(['create','model' => $model,
                'citys'=>$citys]);
        } else {
            return $this->render('create', [
                'model' => $model,'citys'=>$citys
            ]);
        }
    }


    public function actionCountry()
    {    
        $cityId=$_POST['cityId'];
        $countrys=ComCounty::find()->where(['cityCenterId' =>$cityId,'isValid'=>1])->asArray()->all();
        return json_encode($countrys) ;
    }

    public function actionBusiness()
    {    
        $countryId=$_POST['countryId'];
        $business=ComBusinessDistrict::find()->where(['countyId' =>$countryId,'isValid'=>1])->asArray()->all();
        return json_encode($business) ;
    }

    public function actionCategory()
    {
        $category = ComCategoryMaintain::find()->where(['isValid'=>1,'categoryType'=>2])->asArray()->all();
        //print_r($category);
        return json_encode($category);

    }
    /**
     * Lists all StoApplyInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
       if (Yii::$app->request->post()) {
           $dateRange= $_POST['date_range_3'];

          //时间段为空
          if (empty($dateRange)) {
               $fromDate=date("Y-m-d".' 00:00:00');
               $toDate=date("Y-m-d".' 23:59:59');
           }
           else{
               $arr=explode('to', $dateRange);
               $fromDate=$arr[0];
               $toDate=$arr[1];
               $flag=true;
               Yii::$app->session['$flag']=$flag;
               Yii::$app->session['fromDate']= $fromDate;
               Yii::$app->session['$toDate']=$toDate;
           }
       }
       else{
            if (isset(Yii::$app->session['fromDate'])&&isset(Yii::$app->session['$toDate'])) {

               $fromDate=Yii::$app->session['fromDate'];
               $toDate=Yii::$app->session['$toDate'];
            }
            else
            {
               $fromDate=date("Y-m-d".' 00:00:00');
               $toDate=date("Y-m-d".' 23:59:59');
            }
            
       }

        $model=new StoApplyInfo();
        $dataProvider=new ActiveDataProvider([
                'query'=>StoApplyInfo::find()->where('applyStatus=0 and applyTime between "'.$fromDate.'" and "'.$toDate.'"')->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

       return $this->render('index', [
            'dataProvider' => $dataProvider,'model'=>$model,
        ]);
      
    }

    //根据申请id查询明细
    public function actionDetail($applyId)
    {
        //根据申请id查询该条审请信息
        $model=$this->findModel($applyId);
        //市区
        $ComCity=new ComCityCenter();
        $citys = ComCitycenter::find()->all();
        //区县
        $mCounty=new ComCounty();
        $mCountys=ComCounty::find()->all();
        //商圈
        $mBusidist=new ComBusinessDistrict();
        $mBusidists=ComBusinessDistrict::find()->all();
        
        $category=ComCategoryMaintain::find()->where('id="'.$model->storeCategoryId.'"')->one();

        return $this->renderPartial('detail', [
                'model' => $model,'citys'=>$citys,'mCity'=>$ComCity,'mCounty'=>$mCounty,'mCountys'=>$mCountys,
                'mBusidist'=>$mBusidist,'mBusidists'=>$mBusidists,'category'=>$category,
            ]);
    }

    //根据申请id审核或驳回该商家申请的信息
    public function actionUpdate()
    {
      //获取当前登录人  暂时注释
     //Yii::$app->session['loginName']
      $applyStatus=$_POST['applyStatus'];
      $applyId=$_POST['applyId'];
      $result=StoApplyInfo::updateBySql('sto_apply_info',['applyStatus'=>$applyStatus,'customerServiceId'=>'','customerServiceName'=>'','cusServiceReviewTime'=>date('Y-m-d h:i:s')],['applyId'=>$applyId]);
      return json_encode($result);
    }

    public function actionView($id){
      return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the StoApplyInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoApplyInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoApplyInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
