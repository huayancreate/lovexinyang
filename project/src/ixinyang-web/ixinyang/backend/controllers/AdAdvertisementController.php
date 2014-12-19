<?php

namespace backend\controllers;

use Yii;
use backend\models\Ad;
use backend\models\AdSearch;
use backend\models\AdRecommendGoods;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * AdAdvertisementController implements the CRUD actions for Ad model.
 */
class AdAdvertisementController extends Controller
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
     * Lists all Ad models.
     * @return mixed
     */
    /*public function actionIndex()
    {
        $searchModel = new AdSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }*/

     /**
     * Lists all Ad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider=new ActiveDataProvider([
                'query'=>Ad::find()->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

         //商品推荐列表
         $dataProviderRecGoods=new ActiveDataProvider([
                'query'=>AdRecommendGoods::find()->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,'dataProviderRecGoods'=>$dataProviderRecGoods,
        ]);
    }

    /**
     * Displays a single Ad model.
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
     * Creates a new Ad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ad();

        if ($model->load(Yii::$app->request->post())) {
        	if ($model->validate()) {
        		 //创建人员ID  先写固定值
        		 $model->createrId=0;
        		 //创建时间  当前时间
        		 $model->createTime=date("Y-m-d H:i:s");
        		 //对应位置  在数据字典中读取
        		 //$model->mapLocation=1;
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
        } else {
        	$model->isValid='1';
        	$model->startDate=date("Y-m-d");
        	$model->endDate=date("Y-m-d");
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ad model.
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
     * Deletes an existing Ad model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->updateTime=date('Y-m-d H:i:s');
        $model->isValid='0';
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ad::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
