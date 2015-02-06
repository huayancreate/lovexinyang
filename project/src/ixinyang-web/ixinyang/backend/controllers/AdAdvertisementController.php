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
use yii\web\UploadedFile;
use common\models\ComDictionary;
use yii\bootstrap\ActiveForm;
use yii\web\Response;
use common\hycommon\tool\PictureTool;


/**
 * AdAdvertisementController implements the CRUD actions for Ad model.
 */
class AdAdvertisementController extends Controller
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
        $model=$this->findModel($id);
        $comdicModel=ComDictionary::selectCodeNameById($model->mapLocation);

        return $this->renderPartial('view', [
            'model' => $model,
            'comdicModel'=>$comdicModel,
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
        $dictionaryModel=new ComDictionary();
        $model->scenario ='add';

        if ($model->load(Yii::$app->request->post()) && $dictionaryModel->load(Yii::$app->request->post())) {
           
           if ($model->adType==1) {
               $file=UploadedFile::getInstance($model,'file'); //获取上传文件
               $model->file=$file;
           }
           else{
               $file=UploadedFile::getInstance($model,'fileWeb'); //获取上传文件
               $model->fileWeb=$file;
           }
           
            if ($model->validate($model)) {
                 //创建人员ID  先写固定值
                 $model->createrId=0;
                 //创建时间  当前时间
                 $model->createTime=date("Y-m-d H:i:s");
                 //对应位置  
                 $model->mapLocation=(int)$dictionaryModel->codeName;
                 //文件上传
                 $pictureToolModel=new PictureTool();
                 if (count($file)>0) 
                 {
                     $path= $pictureToolModel->uploads($file,1);
                     $file->tempName = $path;
                     $model->photoUrl=$path; //图片路径
                 }
                 //保存
                 $model->save();

            }
             //print_r($model->getErrors());
            return $this->redirect(['index']);
             
        } else {

            //从数据字典表读取广告位置信息
            $dictionaryList=$dictionaryModel->selectByCategory('ad_location');

            //广告类型 1 手机端 、2 web端
            $model->adType='1';
        	$model->isValid='1';
        	$model->startDate=date("Y-m-d");
        	$model->endDate=date("Y-m-d");
            return $this->renderAjax('create', [
                'model' => $model,
                'dictionaryModel'=>$dictionaryModel,
                'dictionaryList'=>$dictionaryList,
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

        //数据字典model
        $dictionaryModel=new ComDictionary();

        if ($model->load(Yii::$app->request->post()) && $dictionaryModel->load(Yii::$app->request->post())) {
           
          if ($model->adType=="1") {
               $file=UploadedFile::getInstance($model,'file'); //获取上传文件
               $model->file=$file;
           }
           else{
               $file=UploadedFile::getInstance($model,'fileWeb'); //获取上传文件
               $model->fileWeb=$file;
           }
           
            $oldPhotoUrl=$model->photoUrl;

             $pictureToolModel=new PictureTool();
            //如果重新选择了其他图片  则重新保存图片
            if (count($file)>0) {
                 $path=$pictureToolModel->uploads($file,1); //文件上传
                 $file->tempName = $path;
                 $model->photoUrl=$path; //图片路径
                 //图片重新上传
                  $model->scenario = 'update';
            }
            else{
                //图片没修改
                $model->scenario='updateoldphoto';
            }
             //对应位置  
             $model->mapLocation=(int)$dictionaryModel->codeName;
             //修改时间
             $model->updateTime=date('Y-m-d H:i:s');
             //保存成功  删除原来的图片
             if($model->save()){
                if (count($file)>0) {
                    //如果重新选择了其他图片  删除原来的图片
                    $pictureToolModel->delfile($oldPhotoUrl);
                }
             }
          
          return $this->redirect(['index']);

        } else {
            //从数据字典表读取广告位置信息
            $dictionaryList=$dictionaryModel->selectByCategory('ad_location');

            return $this->renderAjax('update', [
                'model' => $model,
                'dictionaryModel'=>$dictionaryModel,
                'dictionaryList'=>$dictionaryList,
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

        Ad::updateBySql('ad_advertisement',['updateTime'=>date('Y-m-d H:i:s'),'isValid'=>'0'],['id'=>$id]);

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
