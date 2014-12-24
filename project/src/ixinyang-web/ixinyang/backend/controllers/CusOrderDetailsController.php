<?php

namespace backend\controllers;

use Yii;
use backend\models\CusOrderDetails;
use backend\models\CusOrderDetailsSearch;
use backend\models\CusConsumptionRecords;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CusorderdetailsController implements the CRUD actions for CusOrderDetails model.
 */
class CusorderdetailsController extends Controller
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
     * Lists all CusOrderDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CusOrderDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,1); // search('�ύ����',�̼�ID)

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CusOrderDetails model.
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
     * Creates a new CusOrderDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CusOrderDetails();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CusOrderDetails model.
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
     * Deletes an existing CusOrderDetails model.
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
     * ȷ�����ѣ��������Ѽ�¼�����ӻ�Ա����
     * @return [type] [description]
     */
    public function actionConsumption(){
        
        $transaction=\Yii::$app->db->beginTransaction();

        try{
            $keys=$_POST["keys"];  //��ȡ������ϸID
            foreach ($keys as $key) {
                $model=$this->findModel($key);  //��ȡ������ϸ

                $this->consumptionModel($model)->save(); //����������ˮ

                $model->CodeStatus=2;
                $model->save(); //�޸Ķ���״̬
                //print_r($model);
            }

            $transaction->commit();

        } catch (Exception $e) {

            $transaction->rollback();

            return "�Ƿ�����";
        }
        return $this->redirect(['index']);
    }


    /**
     * Finds the CusOrderDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CusOrderDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CusOrderDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function consumptionModel($item){
        $sumption=new CusConsumptionRecords();
        $sumption->orderId=$item->orderId;  //����ID
        $sumption->goodsId=$item->goodsId;  //��ƷID
        $sumption->verfificationCode=$item->validateCode; //��֤��
        $sumption->goodsNumber=$item->totalNum; //��Ʒ����
        $sumption->costPrice=$item->price; //��Ʒ�۸�
        $sumption->payablePrice=$item->rebatePrice; //ʵ���۸�
        $sumption->rebate=$item->rebate; //�ۿ�
        $sumption->memberCardNo=$item->memberCardNo; //��Ա����
        $sumption->shopId=$item->shopId; //�̼�ID
        $sumption->shopName=$item->shopName; //�̼�����
        $sumption->verifierAccount="verifier-Admin";  //��֤��
        $sumption->verifierTime=date("Y-m-d H:i:s"); //��֤ʱ��
        $sumption->flag="0"; // 0��ƽ̨���� /  1:�ֽ�����
        
        return $sumption;
    }
}
