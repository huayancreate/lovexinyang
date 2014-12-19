<?php

namespace backend\controllers;

use backend\models\ComRefundReview;
use backend\models\ComRefundReviewSearch;
use backend\models\CusConsumptionRecords;
use Yii;
use backend\models\StoSellerInfo;
use backend\models\StoSellerInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StoSellerInfoController implements the CRUD actions for StoSellerInfo model.
 */
class StoSellerInfoController extends Controller
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
     * Lists all StoSellerInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $fromDate = date("Y-m-d" . ' 00:00:00');
        $toDate = date("Y-m-d" . ' 23:59:59');

        $dataProvider = $this->findModel(1);

        $refundModel = new ComRefundReviewSearch();
        $refundDataProvider = $refundModel->getRefundReviews($fromDate, $toDate);

        return $this->render('index', [
            'model' => '2014-12-18',
            'searchModel' => $refundModel,
            'dataProvider' => $dataProvider,
            'refundDataProvider' => $refundDataProvider,
        ]);
    }

    /**
     * Displays a single StoSellerInfo model.
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
     * Creates a new StoSellerInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoSellerInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing StoSellerInfo model.
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
     * Deletes an existing StoSellerInfo model.
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
     * Finds the StoSellerInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoSellerInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoSellerInfo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    public function actionSettle()
    {
        if (Yii::$app->request->post()) {
            $dateRange = $_POST["dateRange"];
            $arr = explode('to', $dateRange);
            $fromDate = $arr[0] . ' 00:00:00';
            $toDate = $arr[1] . ' 23:59:59';
            $model = new CusConsumptionRecords();
            $model->settleAccount($fromDate, $toDate);
        }
        return "";
    }

    public function actionRefund()
    {
        if (Yii::$app->request->post()) {
            $dateRange = $_POST['dateRangeRefund'];
            $arr = explode("to", $dateRange);
            $fromDate = $arr[0] . ' 00:00:00';
            $toDate = $arr[1] . ' 23:59:59';

            $refundModel = new ComRefundReviewSearch();
            $refundDataProvider = $refundModel->getRefundReviews($fromDate, $toDate);
            return $this->renderPartial('refundList', [
                'refundDataProvider' => $refundDataProvider,
            ]);
        }
    }
}