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
            'pagination' => ['pagesize' => '4'],
        ]);

        return $this->renderPartial('index', [
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
        return $this->renderPartial('view', [
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
                $message=$model->getErrors();
                $message["success"]=True;
                return json_encode($message);
        } else {
            //城市
            $cityModel=new ComCitycenter();
            $cityList=ComCitycenter::find()->all();

            return $this->renderPartial('update', [
                'model' => $model,'cityModel'=>$cityModel,'cityList'=>$cityList
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

        $message["success"]=True;
        return json_encode($message);
        //return $this->redirect(['index']);
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






    //客户经理商家信息确认模块
    /**
     * Lists all ShopInfoReview models.
     * @return mixed
     */
    public function actionList()
    {
         if (Yii::$app->request->post()) {
           $dateRange= $_POST['date_range_3'];

          //时间段为空
          if (empty($dateRange)) {
               $fromDate=date("Y-m-d");
               $toDate=date("Y-m-d");
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
               $fromDate=date("Y-m-d");
               $toDate=date("Y-m-d");
            }
            
       }
        $toDate=$toDate.' 23:59:59';
        $dataProvider=new ActiveDataProvider([
                'query'=>ShopInfoReview::find()->where('auditState=1 and applyTime between "'.$fromDate.'" and "'.$toDate.'"')->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
       
    }

    /**
     * Displays a single ShopInfoReview model.
     * @param integer $id
     * @return mixed
     */
    public function actionDetail($id)
    {
        return $this->renderPartial('detail', [
            'model' => $this->findModel($id),
        ]);
    }

     //审核通过
    public function actionCheckpass()
    {
      if (Yii::$app->request->post()){
       //获取当前登录人  暂时注释
       //Yii::$app->session['loginName']
        //申请id
        $id=$_POST["id"];
        //最终审核状态
        $auditState=$_POST["auditState"];
       
        //客户经理Id  暂时写空
        $managerId='111111';
        //客户经理名称 暂时写空
        $managerName='张三';

        //事务开始 
        $transaction=\Yii::$app->db->beginTransaction();
        try {
             //1、根据申请id查询该门店的申请信息
             $model = $this->findModel($id);
            
             //2、门店信息修改
             $this->storeinfoModelSave($model);

             //3、执行修改   门店申请数据的修改
             ShopInfoReview::updateBySql('shop_info_review',['auditState'=>$auditState,'managerId'=>$managerId,'managerName'=>$managerName,'managerTime'=>date('Y-m-d h:i:s')],['id'=>$id]);
             
             //门店审核信息和门店信息都保存成功 True 表示都保存成功
             $message["success"]=True;

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
      $rejection=$_POST['rejection'];
      //审核状态
      $auditState=$_POST['auditState'];
      //申请Id
      $id=$_POST['id'];
      //客户经理Id  暂时写空
      $managerId='111111';
      //客户经理名称 暂时写空
      $managerName='张三';
      //执行修改
      $result=ShopInfoReview::updateBySql('shop_info_review',['auditState'=>$auditState,'managerId'=>$managerId,'managerName'=>$managerName,'managerTime'=>date('Y-m-d h:i:s'),'Rejection'=>$rejection],['id'=>$id]);
      return json_encode($result);
    }

    /**
     * [storeinfoModelSave 新增或保存门店信息  根据 shop_info_review 表中字段 shopId  有值修改 为空则新增]
     * @param  [type] $shopInfoReviewModel [description]
     * @return [type]                      [description]
     */
    protected function storeinfoModelSave($shopInfoReviewModel)
    {

        if (!empty($shopInfoReviewModel->shopId)) {

             $storeInfoModel= StoStoreInfo::find()->where(['id'=>$shopInfoReviewModel->shopId])->one();
        }
        else{

            $storeInfoModel=new StoStoreInfo();
            //创建时间
            $storeInfoModel->createTime=date('Y-m-d H:i:s');
            //是否有效
            $storeInfoModel->validity='1';
        }

         //店铺地址
        $storeInfoModel->storeAddress=$shopInfoReviewModel->address;
        //门店名称
        $storeInfoModel->storeName=$shopInfoReviewModel->shopName;
        //联系方式
        $storeInfoModel->contactWay=$shopInfoReviewModel->contact;
        //商家ID
        $storeInfoModel->sellerId=$shopInfoReviewModel->storeId;
        //营业时间  如：早上10：00到晚上22：00
         $storeInfoModel->businessHours=$shopInfoReviewModel->businessHours;
          //坐标：经度
        $storeInfoModel->longitude=$shopInfoReviewModel->longitude;
        //坐标：纬度
        $storeInfoModel->latitude=$shopInfoReviewModel->latitude;
        //门店概述
        $storeInfoModel->storeOutline=$shopInfoReviewModel->storeOutline;
        //城市id
        $storeInfoModel->cityId=$shopInfoReviewModel->cityId;
        //区县id
        $storeInfoModel->countryID=$shopInfoReviewModel->countyId;
        //商圈id
        $storeInfoModel->businessDistrictId=$shopInfoReviewModel->businessDistrictId;
       
        //审核状态  1、申请中 2、初审通过 3、初审驳回 4、经理审核通过  5、经理审核驳回
        $storeInfoModel->auditState='4';
        //店铺类别
        $storeInfoModel->storeType=$shopInfoReviewModel->storeType;
       
        $storeInfoModel->save();
    }
}
