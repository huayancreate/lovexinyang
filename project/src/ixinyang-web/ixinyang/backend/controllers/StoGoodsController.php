<?php

namespace backend\controllers;

use Yii;
use backend\models\StoGoods;
use backend\models\StoGoodsSearch;
use backend\models\ComCategoryMaintain;
use backend\models\GoodsPicture;
use backend\models\FileUpload;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\StoGoodsStore;

/**
 * StoGoodsController implements the CRUD actions for StoGoods model.
 */
class StoGoodsController extends BackendController
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
     * Lists all StoGoods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StoGoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => ['pagesize' => '5'],
        ]);
    }

    /**
     * Displays a single StoGoods model.
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
     * Creates a new StoGoods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StoGoods();

        if ($model->load(Yii::$app->request->post())) {

            $transaction=\Yii::$app->db->beginTransaction(); 
            try{

                $files = UploadedFile::getInstances($model, 'file');  //获取上传文件

                $model->save();  //商品信息保存

                $this->stoGoodsStoreModelSave($model->id);//��Ʒ��Ӧ������Ϣ�?��

                foreach ($files as $file) {

                    $path=$this->uploads($file); //文件上传

                    $goodsPicture=new GoodsPicture();
                    $goodsPicture->goodsId=$model->id; //商品信息ID
                    $goodsPicture->path=$path; //图片路径
                    $goodsPicture->renewTime=date("Y-m-d H:i:s");
                    $goodsPicture->uploadPersonnel="admin";

                    $goodsPicture->save();
                }

                $transaction->commit(); //事务结束

                // $message=$model->getErrors();
                // $message['success']=true;
                $searchModel=new StoGoodsSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'pagination' => ['pagesize' => '5'],
                ]);

            } catch (Exception $e) {
                $transaction->rollBack();
                $message['success']=false;
            }

            return json_encode($message);

        } else {
            //获取商品类别
            $categoryList =ComCategoryMaintain::find()->where(['categoryType'=>1])->all();

            $model->subClass=1;
            return $this->renderAjax('create', [
                'model' => $model,
                'categoryModel'=>new ComCategoryMaintain(),
                'categoryList'=>$categoryList
            ]);
        }
    }

    /**
     * Updates an existing StoGoods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
                $message=$model->getErrors();
                $message['success']=true;
                return json_encode($message);
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //获取商品类别
            $categoryModel=new ComCategoryMaintain();
            $categoryList =ComCategoryMaintain::find()->where(['categoryType'=>1])->all();
            
            return $this->renderAjax('update', [
                'model' => $model,'categoryModel'=>$categoryModel,'categoryList'=>$categoryList
            ]);
        }
    }

    /**
     * Deletes an existing StoGoods model.
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
     * Finds the StoGoods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StoGoods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StoGoods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 文件上传
     * @param  [type] $files [文件集合]
     * @return [type]        [description]
     */
    protected function uploads($file){

        $filePath = "uploads/goodsPic/";
        
        $ext = $file->getExtension(); //获取文件后缀 如: ".jpg"
        
        $randName = time() . rand(1000, 9999) . "." . $ext; //生成新文件名称

        if(!file_exists($filePath)){
            mkdir($filePath,0777,true);
        }

        $file->saveAs($filePath.$randName); //保存文件

        return $filePath.$randName;
    }

    /**
     * [stoGoodsStoreModelSave ��Ʒ��Ӧ������Ϣ����Ϣ���]
     * @param  [type] $goodsId [��Ʒid]
     * @return [type]          [description]
     */
    protected function stoGoodsStoreModelSave($goodsId){
        $stoGoodsStoreModel=new StoGoodsStore();
        //��Ʒid
        $stoGoodsStoreModel->goodsId=$goodsId;
        //����id    ��session��ȡ   ��ʱдĬ��ֵ
        $stoGoodsStoreModel->storeId=1;
        //�̼�id    ��session��ȡ   ��ʱдĬ��ֵ
        $stoGoodsStoreModel->sellerId=1;
        //��Ʒ���  ��дĬ��ֵ ֮��ᴦ��
        $stoGoodsStoreModel->inventory=1000;
        //����ʱ��  ��ǰʱ��
        $stoGoodsStoreModel->createDate=date("Y-m-d H:i:s");
        //������    ��session��ȡ
        $stoGoodsStoreModel->crreteUserID='111';
        //����
        $stoGoodsStoreModel->save();

    }
}
