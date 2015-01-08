<?php

namespace backend\controllers;

use backend\models\GoodsApplyInfo;
use backend\models\GoodsApplyInfoSearch;
use Yii;
use backend\models\ComGoodsReview;
use backend\models\ComGoodsReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComGoodsReviewController implements the CRUD actions for ComGoodsReview model.
 */
class ComGoodsReviewController extends BackendController
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
     * Lists all ComGoodsReview models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->request->post()) {
            $dateRange= $_POST['date_range_3'];

            //时间段为空
            if (empty($dateRange)) {
                $startDate=date("Y-m-d".' 00:00:00');
                $endDate=date("Y-m-d".' 23:59:59');
            }
            else{
                $arr=explode('to', $dateRange);
                $startDate=$arr[0];
                $endDate=$arr[1];
                $flag=true;
                Yii::$app->session['$flag']=$flag;
                Yii::$app->session['fromDate']= $startDate;
                Yii::$app->session['$toDate']=$endDate;
            }
        }
        else{
            if (isset(Yii::$app->session['fromDate'])&&isset(Yii::$app->session['$toDate'])) {
                $startDate=Yii::$app->session['fromDate'];
                $endDate=Yii::$app->session['$toDate'];
            }
            else
            {
                $startDate=date("Y-m-d".' 00:00:00');
                $endDate=date("Y-m-d".' 23:59:59');
            }

        }
        $model = new ComGoodsReview();
        $dataProvider = $model->getAllGoodS($startDate, $endDate);

//        $searchModel = new GoodsApplyInfoSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComGoodsReview model.
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
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionVerify($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ComGoodsReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComGoodsReview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->cgrId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ComGoodsReview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $type = $_POST["type"];
            $model->verifyGoods($id, $type);

        } else {
            return $this->renderPartial('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ComGoodsReview model.
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
     * Finds the ComGoodsReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComGoodsReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComGoodsReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
