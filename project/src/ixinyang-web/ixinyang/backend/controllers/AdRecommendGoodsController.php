<?php

namespace backend\controllers;

use Yii;
use backend\models\AdRecommendGoods;
use backend\models\AdRecommendGoodsSearch;
use backend\models\StoStoreInfo;
use backend\models\StoGoods;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * AdRecommendGoodsController implements the CRUD actions for AdRecommendGoods model.
 */
class AdRecommendGoodsController extends Controller
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
     * Lists all AdRecommendGoods models.
     * @return mixed
     */
   /* public function actionIndex()
    {
        $searchModel = new AdRecommendGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

    /**
     * Lists all AdRecommendGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
         $dataProvider=new ActiveDataProvider([
                'query'=>AdRecommendGoods::find()->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdRecommendGoods model.
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
     * Creates a new AdRecommendGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdRecommendGoods();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                 //创建人员ID  先写固定值
                 $model->creater=0;
                 //创建时间  当前时间
                 $model->createTime=date("Y-m-d H:i:s");
                 //对应位置  在数据字典中读取
                 //$model->adLocation=1;
                 $model->ad_recommend_goods=$_POST['project-id'];
                 $model->save();

                 //数据验证成功
                  $message=$model->getErrors();
                  $message["success"]=True;

                  return json_encode($message);

            }
            else{
                 //数据验证失败
                  $message=$model->getErrors();
                  $message["success"]=False;
                  return json_encode($message);

            }
        } 
        else {
            $model->ad_advertisement='1';
            $model->isValid='1';
            $model->startDate=date("Y-m-d");
            $model->endDate=date("Y-m-d");
            $jsonStoreInfo=StoStoreInfo::findBySql('select id,storeName from sto_store_info where validity=1 and auditState=4')->asArray()->all();
            $jsonStoGoods=StoGoods::findBySql('select a.id,a.`goodsName`+'-'+c.`storeName` AS goodsName FROM sto_goods AS a JOIN sto_goods_store AS b ON a.id=b.`goodsId` AND a.validity=1 AND a.goodsState=1 JOIN sto_store_info AS c ON b.`storeId`=c.`id` AND c.validity=1 AND c.auditState=4');
           
            return $this->renderPartial('create', [
                'model' => $model,'jsonStoreInfo'=>json_encode($jsonStoreInfo),'jsonStoGoods'=>json_encode($jsonStoGoods)
            ]);
        }
    }

    /**
     * Updates an existing AdRecommendGoods model.
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
     * Deletes an existing AdRecommendGoods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       //$this->findModel($id)->delete();
        $model = $this->findModel($id);
       // $model->updateTime=date('Y-m-d H:i:s');
        $model->isValid='0';
        $model->save();

        return $this->redirect(['ad-advertisement/index']);
        
    }

    /**
     * Finds the AdRecommendGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AdRecommendGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdRecommendGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * [actionSelStoreInfo 查询所有有效 已经审核的店铺]
     * @return [type] [description]
     */
    public function actionSelstoreinfo()
    {
         $storeInfoModel=StoStoreInfo::findBySql('select id,storeName from sto_store_info where validity=1 and auditState=4')->asArray()->all();
         
         
         return json_encode($storeInfoModel);
    }
    
}
