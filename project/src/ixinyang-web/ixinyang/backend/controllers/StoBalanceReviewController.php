<?php

namespace backend\controllers;

use Yii;
use backend\models\StoBalanceReview;
use yii\data\ActiveDataProvider;
use backend\models\StoBalanceReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoBalanceReviewController implements the CRUD actions for StoBalanceReview model.
 */
class StoBalanceReviewController extends BackendController
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
     * Lists all StoBalanceReview models.
     * @return mixed
     */
    public function actionIndex()
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
                'query'=>StoBalanceReview::find()->where('financeReviewStatus=0 and applyTime between "'.$fromDate.'" and "'.$toDate.'"')->asArray(),
                'pagination' => ['pagesize' => '5'],
                ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StoBalanceReview model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StoBalanceReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoBalanceReview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StoBalanceReview model.
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
     * Deletes an existing StoBalanceReview model.
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
     * Finds the StoBalanceReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoBalanceReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoBalanceReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
