<?php

namespace backend\controllers;

use Yii;
use backend\models\ComRefundReview;
use backend\models\ComRefundReviewSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComRefundReviewController implements the CRUD actions for ComRefundReview model.
 */
class ComRefundReviewController extends Controller
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
     * Lists all ComRefundReview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComRefundReview();
        $fromDate = date("Y-m-d");
        $toDate = date("Y-m-d");
        $dateRange = $fromDate . " to " . $toDate;
        if (Yii::$app->request->post()) {
            $dateRange = $_POST["dateRange"];
            if (!empty($dateRange)) {
                $arr = explode("to", $dateRange);
                $fromDate = $arr[0];
                $toDate = $arr[1];
            }
        }
        $dataProvider = $searchModel->getRefundReviews($fromDate . ' 00:00:00', $toDate . ' 23:59:59');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dateRange' => $dateRange,
        ]);
    }

    /**
     * Displays a single ComRefundReview model.
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
     * Creates a new ComRefundReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComRefundReview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ComRefundReview model.
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
     * Deletes an existing ComRefundReview model.
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
     * Finds the ComRefundReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComRefundReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComRefundReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionVerify()
    {
        if (Yii::$app->request->post()) {
            $id = $_POST["id"];
            $model = $this->findModel($id);
            $status = $_POST["status"];
            $model->verifyRefundReview($status);
        }

    }

    /**
     * 退款订单详情
     */
    public function actionDetail()
    {
        $model = new ComRefundReview();
        $id = 1;
        $order = $model->findOrderById($id);
        $orderDetail = $model->findOrderDetailByOrderId($id);

        return $this->renderPartial("detail", [
            'order' => $order,
            'orderDetail' => $orderDetail,
            'model' => $this->findModel($id),
        ]);

    }
}
