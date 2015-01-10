<?php

namespace backend\controllers;

use Yii;
use backend\models\CusConsumptionRecords;
use backend\models\CusElectronicCard;
use backend\models\StoMemberRule;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ConsumptionController implements the CRUD actions for CusConsumptionRecords model.
 */
class ConsumptionController extends Controller
{
    /*public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }*/

    /**
     * Lists all CusConsumptionRecords models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new CusConsumptionRecords();
        $member=new StoMemberRule();
        $member->ico="uploads/vipPicture/hybg.png";

        return $this->render('index', [
            'dataProvider' =>  $this->getConsumptionRecords(),
            'pagination' => ['pagesize' => '5'],
            'model'=>$model,
            'member'=>$member,
        ]);
    }

    /**
     * Displays a single CusConsumptionRecords model.
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
     * Creates a new CusConsumptionRecords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CusConsumptionRecords();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing CusConsumptionRecords model.
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
     * 现金消费保存
     * @return [type] [description]
     */
    public function actionCashsave(){

        $model =new CusConsumptionRecords();
        $member=new StoMemberRule();
        $member->ico="uploads/vipPicture/hybg.png";

        if($model->load(Yii::$app->request->post())){

            $model->verifierTime=date("Y-m-d H:i:s");

            $model->save();
           
             return $this->redirect(['index']);
        }
    }



    /**
     * 会员消费折扣信息
     * @return [type] [description]
     */
    public function actionMemberinfo(){

        $model =new CusConsumptionRecords();
        $member=new StoMemberRule();
        $member->ico="uploads/vipPicture/hybg.png";
        
        if ($model->load(Yii::$app->request->post())){

            $card=CusElectronicCard::find()->where(['memberCardNumber' => $model->memberCardNo])->one();
            if($card!=null){
                $member=$member->find()->where(['id'=>$card->memberId])->one();
                $model->rebate=$member->rebate;
            }else{
                $model =new CusConsumptionRecords();
            }

            return $this->render('index', [
                'dataProvider' => $this->getConsumptionRecords($model->memberCardNo),
                'pagination' => ['pagesize' => '5'],
                'model'=>$model,
                'member'=>$member
            ]);
        }
    }

    protected function getConsumptionRecords($code=""){
        $dataProvider = new ActiveDataProvider([
            'query' => CusConsumptionRecords::find()->where(['memberCardNo'=>$code]),
        ]);
        return $dataProvider;
    }

    /**
     * Finds the CusConsumptionRecords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CusConsumptionRecords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CusConsumptionRecords::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
