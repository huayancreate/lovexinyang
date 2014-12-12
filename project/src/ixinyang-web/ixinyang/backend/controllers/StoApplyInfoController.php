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
use backend\models\StoSellerInfo;
use backend\models\StoStoreInfo;
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
      if (Yii::$app->request->post()){
       //获取当前登录人  暂时注释
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
        $transaction=\Yii::$app->db->beginTransaction();
        try {
             //1、根据申请id查询该商家的申请信息
             $model = $this->findModel($applyId);
            
             //商家信息保存成功后获取 商家ID
             $sellerId=$this->sellerInfoModelSave($model);

             //门店信息保存成功后获取门店id
             $storeInfoId=$this->storeInfoModelSave($model,$sellerId);

               //2、执行修改   商家申请数据的修改
            
             StoApplyInfo::updateBySql('sto_apply_info',['applyStatus'=>$applyStatus,'customerManagerId'=>$customerManagerId,'customerManagerName'=>$customerManagerName,'cusManagerReviewTime'=>date('Y-m-d h:i:s')],['applyId'=>$applyId]);
             
             //print_r($storeInfoId);
             //商家信息和门店信息都保存成功 True 表示都保存成功
             $message["success"]=True;
             //商家ID
             $message["sellerId"]=$sellerId;
              //门店id
             $message["storeInfoId"]=$storeInfoId;

             //提交
            $transaction->commit();
           } 
        catch (Exception  $e) {
            $transaction->rollBack();
            $message["success"]=False;
            $message["errormsg"]=$e;
        }
       
        return json_encode($message);
      }
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

    /**
    *商家信息的保存
    */
    protected function sellerInfoModelSave($applyInfoModel){
                  //商家信息model
                  $stoSellerInfoModel=new StoSellerInfo();
                 //把数据添加到商家信息表中
                 //客户经理id
                 $stoSellerInfoModel->customerManager=$applyInfoModel->customerManagerId;
                 //其他联系方式
                 $stoSellerInfoModel->otherContactWay=$applyInfoModel->otherContact;
                 //商家概述
                 $stoSellerInfoModel->summary=$applyInfoModel->scopeBusiness;
                 //是否有效 0->无效 1->有效  初次添加默认有效
                 $stoSellerInfoModel->validity='1';
                 //联系人
                 $stoSellerInfoModel->contacts=$applyInfoModel->name;
                 //手机
                 $stoSellerInfoModel->phone=$applyInfoModel->phone;
                 //商家Email、邮箱
                 $stoSellerInfoModel->email=$applyInfoModel->email;

                 //把商家信息进行保存
                 $stoSellerInfoModel->save();
                 //返回商家信息id
                 return $stoSellerInfoModel->id;
    }
   
    /**
     * [storeInfoModelSave description]
     * @param  [type] $applyInfoModel [description]
     * @param  [type] $sellerId       [description]
     * @return [type]                 [description]
     */
    protected function storeInfoModelSave($applyInfoModel,$sellerId){
                 //门店 model
                 $stoStoreInfoModel=new StoStoreInfo();
                 //把数据添加到门店表中
                 //创建时间  当前时间
                 $stoStoreInfoModel->createTime=date('Y-m-d h:i:s');
                 //店铺地址
                 $stoStoreInfoModel->storeAddress=$applyInfoModel->address;
                 //店铺类别
                 $stoStoreInfoModel->storeType=$applyInfoModel->storeCategoryId;
                 //门店名称
                 $stoStoreInfoModel->storeName=$applyInfoModel->storeName;
                 //联系方式
                 $stoStoreInfoModel->contactWay=$applyInfoModel->otherContact;
                 //商家ID
                 $stoStoreInfoModel->sellerId=$sellerId;
                 //是否有效  初次添加默认 有效 1
                 $stoStoreInfoModel->validity='1';
                 //坐标：经度
                 $stoStoreInfoModel->longitude=$applyInfoModel->longitude;
                 //坐标：纬度
                 $stoStoreInfoModel->latitude=$applyInfoModel->latitude;
                 //门店概述
                 $stoStoreInfoModel->storeOutline=$applyInfoModel->scopeBusiness;
                 //商圈id
                 $stoStoreInfoModel->businessDistrictId=$applyInfoModel->businessZone;
                 //城市id
                 $stoStoreInfoModel->cityId=$applyInfoModel->city;
                 //区县id
                 $stoStoreInfoModel->countryID=$applyInfoModel->regional;
                 //保存门店信息
                 $stoStoreInfoModel->save();
                 //返回门店信息id
                 return $stoStoreInfoModel->id;

    }

}
