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
      return $this->renderPartial('view', [
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



    //客户经理中心模块  洽谈任务
    public function actionDiscusstasks()
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
        //最终审核状态 是1 说明是客服申请成功 等待客户经理审核  
        $applyStatus=1;
        $model=new StoApplyInfo();
        $dataProvider=new ActiveDataProvider([
                'query'=>StoApplyInfo::find()->where('applyStatus="'.$applyStatus.'" and applyTime between "'.$fromDate.'" and "'.$toDate.'"')->asArray(),
                //'query'=>$model->selectByApplyTimeAndApplyStatus($applyStatus,$fromDate,$toDate),
                'pagination' => ['pagesize' => '5'],
                ]);

       return $this->render('discusstasks', [
            'dataProvider' => $dataProvider,'model'=>$model,
        ]);
      
    }
     //根据申请id查询明细
    public function actionCusmanagerreview($applyId)
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

        return $this->renderPartial('cusmanagerreview', [
                'model' => $model,'citys'=>$citys,'mCity'=>$ComCity,'mCounty'=>$mCounty,'mCountys'=>$mCountys,
                'mBusidist'=>$mBusidist,'mBusidists'=>$mBusidists,'category'=>$category,
            ]);
    }
    //审核通过
    public function actionCheckpass()
    {
        /* //获取当前登录人  暂时注释
       //Yii::$app->session['loginName']
        //申请id
        $applyId=$_POST["applyId"];
        //最终审核状态
        $applyStatus=$_POST["applyStatus"];
        //客户经理Id  暂时写空
        $customerManagerId='111111';
        //客户经理名称 暂时写空
        $customerManagerName='张三';
       

        //事务开始
        $transaction = $this->getDb()->beginTransaction();
        try {
                //1、执行修改   商家申请数据的修改
               $result=StoApplyInfo::updateBySql('sto_apply_info',['applyStatus'=>$applyStatus,'customerManagerId'=>$customerManagerId,'customerManagerName'=>$customerManagerName,'cusManagerReviewTime'=>date('Y-m-d h:i:s')],['applyId'=>$applyId]);
               //2、根据申请id查询该商家的申请信息
               $model = $this->findModel($applyId);
               $stoSellerInfoModel=new StoSellerInfo();
               //客户经理id
               $stoSellerInfoModel->customerManager=$model->customerManagerId;
               //其他联系方式
               $stoSellerInfoModel->otherContactWay=$model->otherContact;
               //商家概述
               $stoSellerInfoModel->summary=$model->scopeBusiness;
               //商户名称
               $stoSellerInfoModel->sellerName=$model->storeName;
               //是否有效 0->无效 1->有效  初次添加默认有效
               $stoSellerInfoModel->validity='1';
               //联系人
               $stoSellerInfoModel->contacts=$model->name;
               

               //提交
               $transaction->commit();

           } 
        catch (Exception  $e) {

            $transaction->rollBack();

        }
       
        return json_encode($result);*/
    }

     //审核驳回 需要填写驳回备注
    public function actionCheckfail()
    {
       //获取当前登录人  暂时注释
       //Yii::$app->session['loginName']
      //驳回备注
      $remark=$_POST['remark'];
      //审核状态
      $applyStatus=$_POST['applyStatus'];
      //申请Id
      $applyId=$_POST['applyId'];
      //客户经理Id  暂时写空
      $customerManagerId='111111';
      //客户经理名称 暂时写空
      $customerManagerName='张三';
      //执行修改
      $result=StoApplyInfo::updateBySql('sto_apply_info',['applyStatus'=>$applyStatus,'customerManagerId'=>$customerManagerId,'customerManagerName'=>$customerManagerName,'cusManagerReviewTime'=>date('Y-m-d h:i:s'),'remark'=>$remark],['applyId'=>$applyId]);
      return json_encode($result);

    }
}
