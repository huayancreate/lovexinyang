<?php

namespace backend\controllers;

use Yii;
use backend\models\CusConsumptionRecords;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use backend\models\StoBalanceReview;
use backend\models\StoBalanceBillDetailed;
use backend\models\ComCheckoutStream;
use backend\models\CusConsumptionRecordsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\StoSellerInfo;
use backend\models\StoStoreInfo;



/**
 * CusConsumptionRecordsController implements the CRUD actions for CusConsumptionRecords model.
 */
class CusConsumptionRecordsController extends BackendController
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
     * Lists all CusConsumptionRecords models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new CusConsumptionRecordsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CusConsumptionRecords model.
     * @param integer $id
     * @param string $verifierTime
     * @return mixed
     */
    public function actionView($id, $verifierTime)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $verifierTime),
        ]);
    }

    /**
     * Creates a new CusConsumptionRecords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CusConsumptionRecords();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id, 'verifierTime' => $model->verifierTime]);

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CusConsumptionRecords model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param string $verifierTime
     * @return mixed
     */
    public function actionUpdate($id, $verifierTime)
    {
        $model = $this->findModel($id, $verifierTime);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'verifierTime' => $model->verifierTime]);
      }
    }

    /**
     * Deletes an existing CusConsumptionRecords model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param string $verifierTime
     * @return mixed
     */
    public function actionDelete($id, $verifierTime)
    {
      $this->findModel($id, $verifierTime)->delete();
      return $this->redirect(['index']);

    }

    /**
     * Finds the CusConsumptionRecords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param string $verifierTime
     * @return CusConsumptionRecords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $verifierTime)
    {
      if (($model = CusConsumptionRecords::findOne(['id' => $id, 'verifierTime' => $verifierTime])) !== null) {
      }else{
        throw new NotFoundHttpException('The requested page does not exist.');
      }
    }

    /**
     * 结算审核
     * Lists all CusConsumptionRecords models.
     * @return mixed
     */
    public function actionClosingaudit($id,$balanceStartTime,$balanceEndTime,$shopId)
    {
       
       if (Yii::$app->request->post()) {

           /*//结算起始时间
           $balanceStartTime=$_POST['balanceStartTime'];
           //结算结束时间
           $balanceEndTime=$_POST['balanceEndTime'];
           //店铺id
           $shopId=$_POST['shopId'];
           //商家结算审核表主键id
           $id=$_POST['id'];*/

           //session保留值  结算起始时间
           Yii::$app->session['$balanceStartTime']=$balanceStartTime;
            //session保留值  结算结束时间
           Yii::$app->session['$balanceEndTime']=$balanceEndTime;
            //session保留值  店铺id
           Yii::$app->session['$shopId']=$shopId;
             //session保留值  商家结算审核表主键id
           Yii::$app->session['$id']=$id;
         
       }
       else{
          //session取值  结算起始时间
          $balanceStartTime=Yii::$app->session['$balanceStartTime'];
          //session取值  结算起始时间
          $balanceEndTime=Yii::$app->session['$balanceEndTime'];
          //session取值  店铺id
          $shopId=Yii::$app->session['$shopId'];
          //session取值  商家结算审核表主键id
          $id=Yii::$app->session['$id'];
       }

         $dataProvider = new ActiveDataProvider([
            'query' => CusConsumptionRecords::find()->where('shopId="'.$shopId.'" and flag=0 and verifierTime between "'.$balanceStartTime.'"  and "'.$balanceEndTime.'" ')->asArray(),
            'pagination' => ['pagesize' => '10'],
          ]);

           //总计
           $consumpRecModel=CusConsumptionRecords::findBySql('SELECT SUM(payablePrice) AS payablePrice FROM cus_consumption_records WHERE shopId=1  AND verifierTime BETWEEN "'.$balanceStartTime.'" AND  "'.$balanceEndTime.'" ')->one();
           //商家结算审核
           $balanceReviewModel=new StoBalanceReview();
           //结算申请id
           $balanceReviewModel->id=$id;
           //结算起始时间
           $balanceReviewModel->balanceStartTime=$balanceStartTime;
           //结算结束时间
           $balanceReviewModel->balanceEndTime=$balanceEndTime;
           //店铺id
           $balanceReviewModel->shopId=$shopId;

            return $this->render('closingaudit', [
                'dataProvider' => $dataProvider,'consumpRecModel'=>$consumpRecModel,'balanceReviewModel'=>$balanceReviewModel
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
          $financeReviewStatus=$_POST['financeReviewStatus'];
          //结算起始时间
          $balanceStartTime=$_POST['balanceStartTime'];
          //结算结束时间
          $balanceEndTime=$_POST['balanceEndTime'];
          //店铺id
          $shopId=$_POST['shopId'];
          //财务人员Id   从session读取
          $financeId=Yii::$app->user->identity->id;
          //财务人员账号 从session读取
          $financeAccount=Yii::$app->user->identity->role;
        //事务开始 
        $transaction=\Yii::$app->db->beginTransaction();
        try {
              //转账成功
              if ($this->transferResult()) {
                    //结款流水信息保存
                   $checkoutStreamModel=$this->checkoutstreamSave($id);

                   //1、根据店铺id  验证时间 flag为0(在平台消费)
                   $query = CusConsumptionRecords::find()->where('shopId="'.$shopId.'" and flag=0 and verifierTime between "'.$balanceStartTime.'"  and "'.$balanceEndTime.'" ')->all();
                   
                   //2、则把【cus_consumption_records】消费记录、流水表 中的数据复制到【sto_balance_bill_detailed】商家结算账单明细中 
                   $balanceBillDetailCount=$this->balanceBillDetailedModelSave($query,$id);

                  if ($checkoutStreamModel->save() && $balanceBillDetailCount==count($query)) {
                       //店铺余额的修改   传店铺id和结款的金额
                       $storeBalanceResult=$this->storeInfoAccBalanceModify($shopId,$checkoutStreamModel->balanceMoney);
                       //商家余额的修改   传商家id和结款的金额
                       $sellBalanceResult=$this->sellerInfoAccBalanceModify($checkoutStreamModel->storeId,$checkoutStreamModel->balanceMoney);
                       if ($storeBalanceResult->save()&&$sellBalanceResult->save()) {
                             //3、执行修改   商家结算审核数据的修改
                           StoBalanceReview::updateBySql('sto_balance_review',['financeReviewStatus'=>$financeReviewStatus,'financeId'=>$financeId,'financeAccount'=>$financeAccount,'financeReviewTime'=>date('Y-m-d h:i:s'),'actualBalanceMoney'=>$checkoutStreamModel->balanceMoney],['id'=>$id]);
                           
                           // 转账成功 并且消费记录、流水表保存成功 True 表示都保存成功
                           $message["success"]=True;
                           //提交
                           $transaction->commit();
                       }
                       else{
                           $message["success"]=False;
                            $transaction->rollBack();
                       }
                       
                  }
                  else{
                      $message["success"]=False;
                      $message["errormsg"]='转账成功，结款流水表插入信息失败或消费记录、流水表 中的数据复制到商家结算账单明细表失败，请联系平台管理员';
                  }
                  
              }
             else{//转账失败
              
                   $message["success"]=False;
                   $message["errormsg"]='转账失败';
             }
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
      $financeReviewStatus=$_POST['financeReviewStatus'];
      //申请Id
      $id=$_POST['id'];
      //财务人员Id
      $financeId=Yii::$app->user->identity->id;
      //财务人员账号
      $financeAccount=Yii::$app->user->identity->role;
      //执行修改
      $result=StoBalanceReview::updateBySql('sto_balance_review',['financeReviewStatus'=>$financeReviewStatus,'financeId'=>$financeId,'financeAccount'=>$financeAccount,'financeReviewTime'=>date('Y-m-d h:i:s'),'remark'=>$remark],['id'=>$id]);
      return json_encode($result);
    }

    //预留发起转账接口
    protected function transferResult()
    {
        return true;
    }

    /**
     *checkoutstreamSave 结款流水信息保存  
     * @param  [type] $id [结款申请id]
     * @return [type]     [结款流水model]
     */
    protected function checkoutstreamSave($id)
    {
        //根据商家结算审核id查询该申请记录
        $balanceReviewModel=StoBalanceReview::findOne($id);
        $checkoutStreamModel=new ComCheckoutStream();
        //操作人Id  从session读取
        $checkoutStreamModel->operatorId=Yii::$app->user->identity->id;
        //操作人账号 从session读取
        $checkoutStreamModel->operatorAccount=Yii::$app->user->identity->role;
        //操作时间
        $checkoutStreamModel->operatorTime=date('Y-m-d H:i:s');
        //存入支付宝名称  从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->depositAlipayName=$balanceReviewModel->alipayName;
        //存入支付宝账号  从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->depositAlipayAccount=$balanceReviewModel->alipayNo;
        //接口流水编号    接口返回
        $checkoutStreamModel->interfaceSerialNumber='12345678';
        //结款金额        从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->balanceMoney=$balanceReviewModel->applyMoney;
        //结款申请Id      从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->balanceApplyId=$balanceReviewModel->id;
        //结款时间        和支付时间相同
        $checkoutStreamModel->balanceTime=date('Y-m-d H:i:s');
        //商家Id           从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->storeId=$balanceReviewModel->storeId;
        //商家名称         从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->storeName=$balanceReviewModel->storeName;
        //支出支付宝名称  从配置文件读取
        $checkoutStreamModel->expenditureAlipayName='111';
        //支出支付宝账号  从配置文件读取
        $checkoutStreamModel->expenditureAlipayAccount='111';
        //支付宝交易流水  接口返回
        $checkoutStreamModel->alipayTransactionStream='111';
        //支付时间        接口返回
        $checkoutStreamModel->payTime=date('Y-m-d H:i:s');
        //店铺id   从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->shopId=$balanceReviewModel->shopId;
        //店铺名称 从【sto_balance_review】商家结算审核读取
        $checkoutStreamModel->shopName=$balanceReviewModel->shopName;
        return $checkoutStreamModel;
    }

      /**
     * [balanceBillDetailedModelSave 则把【cus_consumption_records】消费记录、流水表 中的数据复制到【sto_balance_bill_detailed】商家结算账单明细中 ]
     * @return [type] [description]
     */
    protected function balanceBillDetailedModelSave($consumpRecQuery,$id)
    {
      
      //作为标识 插入数据库是否都成功
      $flag=0;
      foreach ($consumpRecQuery as $consumpRecModel)
      {
        //商家结算账单明细
        $model=new StoBalanceBillDetailed();
        //结算申请Id
        $model->balanceApplyId=$id;
        //商品Id
        $model->goodsId=$consumpRecModel->goodsId;
        //商品数量
        $model->goodsNumber=$consumpRecModel->goodsNumber;
        //消费交易流水id
        $model->consumeSaleStream=$consumpRecModel->id;
        //消费实付金额
        $model->payablePrice=$consumpRecModel->payablePrice;
        //消费原金额
        $model->costPrice=$consumpRecModel->costPrice;
        //验证码
        $model->verificationCode=$consumpRecModel->verfificationCode;
        //验证人账号
        $model->verificaterAccount=$consumpRecModel->verifierAccount;
        //验证时间
        $model->verificateTime=$consumpRecModel->verifierTime;
        //用户会员卡卡号
        $model->membershipCardNumber=$consumpRecModel->memberCardNo;
        //用户账号
        $model->userAccount=$consumpRecModel->userAccount;
        //用户折扣
        $model->userDiscount=$consumpRecModel->rebate;
        //订单id
        $model->orderId=$consumpRecModel->orderId;
        //店铺id
        $model->shopId=$consumpRecModel->shopId;
        //店铺名称
        $model->shopName=$consumpRecModel->shopName;
        //商家id
        $model->sellerId=$consumpRecModel->sellerId;
        //商家名称
        $model->sellerName=$consumpRecModel->sellerName;
        if($model->save())
        {
          $flag=$flag+1;
        }
      }
        return $flag;
    }

    /**
     * [sellerInfoAccBalanceModify 商家余额的修改]
     * @param  [type] $id [商家id]
     * @return [type]     [返回bool  修改成功返回true  不成功返回false]
     */
    protected function sellerInfoAccBalanceModify($id,$accountBalance)
    {
       //根据商家id查询该商家的记录
       $sellerInfoModel=StoSellerInfo::findOne($id);
       //计算出余额  原来的商家余额减去这次结款的金额
       $sellerInfoModel->accountBalance=$sellerInfoModel->accountBalance-$accountBalance;
       return $sellerInfoModel;
    }
    /**
     * [storeInfoAccBalanceModify 店铺余额的而修改]
     * @param  [type] $id [店铺id]
     * @return [type]     [返回bool  修改成功返回true  不成功返回false]
     */
    protected function storeInfoAccBalanceModify($id,$accountBalance)
    {
       //根据店铺id查询该店铺的记录
       $storeInfoModel=StoStoreInfo::findOne($id);
       //计算出余额  原来的店铺余额减去这次结款的金额
       $storeInfoModel->accountBalance=$storeInfoModel->accountBalance-$accountBalance;
       return $storeInfoModel;
    }


}
