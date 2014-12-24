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
        return $this->renderPartial('view', [
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
                 $file=UploadedFile::getInstance($model,'file'); //获取上传文件

                 $path=$this->uploads($file); //文件上传
                 $model->photoUrl=$path; //图片路径

        		 $model->save();

                 return $this->redirect(['index']);
        		
        	}
        	else{
        		 //数据验证失败
                 return $this->redirect(['create']);
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
        if ($model->load(Yii::$app->request->post())) {
            //flag 0->没有改变  1->图片有变动 
            $file=UploadedFile::getInstance($model,'file'); //获取上传文件
            $oldPhotoUrl=$model->photoUrl;
            //如果重新选择了其他图片  则重新保存图片
            if (count($file)>0) {
                 $path=$this->uploads($file); //文件上传
                 $model->photoUrl=$path; //图片路径
            }
             $model->updateTime=date('Y-m-d H:i:s');
             //保存成功  删除原来的图片
             if($model->save()){
                if (count($file)>0) {
                    //如果重新选择了其他图片  删除原来的图片
                    $this->delfile($oldPhotoUrl);
                }
             }

            return $this->redirect(['index']);

        } else {
            return $this->renderAjax('update', [
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

    /**
     * 文件上传
     * @param  [type] $files [文件集合]
     * @return [type]        [description]
     */
    protected function uploads($file){
        //广告图片路径
        $filePath = "uploads/adPic/";
        
        //$ext = $this->getExtension($file); //获取文件后缀 如: ".jpg"
        $ext=$file->extension;
        
        $randName = time() . rand(1000, 9999) . "." . $ext; //生成新文件名称

        if(!file_exists($filePath)){
            mkdir($filePath,0777,true);
        }

        $file->saveAs($filePath.$randName); //保存文件

        return $filePath.$randName;
    }

    
    /**
     * [delfile 删除某个图片]
     * @param  [type] $fullpath [图片路径]
     * @return [type]           [description]
     */
    protected function delfile($fullpath) {
          if(!is_dir($fullpath)) {
              unlink($fullpath);//删除目录中的所有文件
          } else {
              delfile($fullpath);
          }
    }
    




}
