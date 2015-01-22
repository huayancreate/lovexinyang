<?php

namespace backend\controllers;

use Yii;
use backend\models\ComCounty;
use backend\models\ComBusinessDistrict;
use backend\models\ComCityCenter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;




/**
 * ComcountyController implements the CRUD actions for ComCounty model.
 */
class ComCountyController extends BackendController
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
     * Lists all ComCounty models.
     * @return mixed
     */
    public function actionIndex()
    {
        //市区类
        $ComCity=new ComCityCenter();
        $ComCitys= ComCityCenter::find()->all(); 

        //区县类   区县列表展示
        $model = new ComCounty();
        
        $dataProvider=new ActiveDataProvider([
                'query'=>$model->find()->where('isValid=1')->asArray(),
                'pagination' => ['pagesize' => '5'],

                ]);
        
          $model->isValid=1;
          return $this->render('index', [
                                'model' => $model,
                                'mCity'=>$ComCity,'mCitys'=>$ComCitys,'dataProvider'=>$dataProvider,
                               
                         ]);
          
    }

    /**
     * [选择下拉框是否有效查询区县信息  0->无效 1->有效 2->全部]
     * @return [type] [description]
     */
    public function actionSearch()
    {
         //区县类   区县列表展示
        $model = new ComCounty();

        if (Yii::$app->request->post()) {
           
            $model->isValid=$_POST["isValidDrop"];
            //session值
            Yii::$app->session['$isValid']=$model->isValid;
        }
        else{
            if (isset(Yii::$app->session['$isValid'])){
                $model->isValid=Yii::$app->session['$isValid'];
            }else{
                $model->isValid=1;
            }
        }
         //市区类
        $ComCity=new ComCityCenter();
        $ComCitys= ComCityCenter::find()->all(); 

          if ($model->isValid==2) {//全部
                    $query=$model->find()->asArray();
                }
                else{//1 有效 或 0 无效
                    $query=$model->find()->where('isValid='.$model->isValid)->asArray();
                }

                $dataProvider=new ActiveDataProvider([
                        'query'=>$query,
                        'pagination' => ['pagesize' => '5'],

                        ]);
                
                  return $this->render('index', [
                                        'model' => $model,
                                        'mCity'=>$ComCity,'mCitys'=>$ComCitys,'dataProvider'=>$dataProvider,
                                       
                                 ]);
        
          
    }


    /**
     * Displays a single ComCounty model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $ComCityCenterModel=ComCityCenter::find()->where(['id'=>$model->cityCenterId])->one();
        return $this->render('view', [
            'model' => $model,'ComCityCenterModel'=>$ComCityCenterModel,
        ]);
    }

    /**
     * Creates a new ComCounty model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        //市区类
        $ComCity=new ComCityCenter();
        $ComCitys= ComCityCenter::find()->all(); 

        //区县类   区县列表展示
        $model = new ComCounty();
        //区县添加
       if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                 //获取市区id
                 if($ComCity->load(Yii::$app->request->post())){
                       $cId=(int)$ComCity->cityCenterName;
                       $model->cityCenterId=$cId;
                  }
                
                $model->save();
                
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
        } 
        else 
        {
             $model->isValid='1';
             return $this->renderPartial('create', [
                    'model' => $model,
                    'mCity'=>$ComCity,'mCitys'=>$ComCitys,
                   
             ]);
         }
    }

    /**
     * Updates an existing ComCounty model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $ComCity=new ComCityCenter();
        $ComCitys= ComCityCenter::find()->all();

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($ComCity->load(Yii::$app->request->post())){
                             $cId=(int)$ComCity->cityCenterName;
                             $model->cityCenterId=$cId;
                         }
                $model->save();
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
            return $this->renderPartial('update', [
                'model' => $model,
                'mCity'=>$ComCity,'mCitys'=>$ComCitys,'cityCenterId'=>$model->cityCenterId,
            ]);
        }
    }

    /**
     * Deletes an existing ComCounty model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {   
        ComCounty::updateBySql('com_county',['isValid'=>0],['countyId'=>$id]);
        ComBusinessDistrict::updateBySql('com_business_district',['isValid'=>0],['countyId'=>$id]);
        
        return  $this->redirect('index.php?r=com-county/index');
    }

    public function actionActive($id)
    {
        ComCounty::updateBySql('com_county',['isValid'=>1], ['countyId' =>$id]);
        return $this->render('index');
    }

    /**
     * Finds the ComCounty model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComCounty the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComCounty::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



    //商圈模块部分  修改
    public function actionBusinessdistrictupdate($businessDistrictId)
    {
        $model = new ComCounty();
        $models=ComCounty::find()->where(['isValid'=>'1'])->all();

       $ComBusinessDistrict=$this->findBusinessdistrictmodel($businessDistrictId);

        if ($ComBusinessDistrict->load(Yii::$app->request->post())) {
           if ($ComBusinessDistrict->validate()) {
                if ($model->load(Yii::$app->request->post())) {
                          $countyId=(int)$model->countyName;
                          $ComBusinessDistrict->countyId=$countyId;
                        }

                $ComBusinessDistrict->save();

                $message=$ComBusinessDistrict->getErrors();
                $message["success"]=True;
                return json_encode($message);
               
           }
           else{
                $message=$ComBusinessDistrict->getErrors();
                $message["success"]=False;
                return json_encode($message);
           }
            
        } else {//初始进入修改页面
            return $this->renderPartial('businessdistrictupdate', [
                'model' => $model,'models'=>$models,'ComBusinessDistrict'=>$ComBusinessDistrict,
                
            ]);
        }
    }

      

     /*
        商圈view查看
     */
    public function actionBusinessdistrictview($businessDistrictId)
    {
        $Businessdistricmodel=$this->findBusinessdistrictmodel($businessDistrictId);

        $ComCountyModel=ComCounty::find()->where(['countyId'=>$Businessdistricmodel->countyId])->one();

        return $this->render('businessdistrictview', [
            'Businessdistricmodel' => $Businessdistricmodel,'ComCountyModel'=>$ComCountyModel,
        ]);
    }

    //商圈的删除
    public function actionBusinessdistrictdelete($businessDistrictId)
    { 
        $result=ComBusinessDistrict::updateBySql('com_business_district',['isValid'=>0],['businessDistrictId'=>$businessDistrictId]);
        
        return  $this->redirect('index.php?r=com-county/index');
      

    }
    /*
        商圈一条model记录
     */
     protected function findBusinessdistrictmodel($businessDistrictId)
     {
        if (($Businessdistricmodel = ComBusinessDistrict::findOne($businessDistrictId)) !== null) {
            return $Businessdistricmodel;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
     }

     /*
       根据区县Id查询该区县下的所有商圈信息
     */
     public function actionSelectinfo($countyId)
     {
         //商圈类
        $ComBusinessDistrict=new ComBusinessDistrict();
        //商圈的列表部分
         $ComBusinessDistrictdataProvider=new ActiveDataProvider([
                'query'=>$ComBusinessDistrict->find()->where('isValid=1 and countyId='.$countyId)->asArray(),
                'pagination' => ['pagesize' => '10'],

                ]);
    
       return  $this->renderPartial('businessdistrictlist',['ComBusinessDistrictdataProvider'=>$ComBusinessDistrictdataProvider,
                'ComBusinessDistrict'=>$ComBusinessDistrict,'countyId'=>$countyId,
               ]) ;
     }

     //商圈的添加
     public function actionBusinessdistrictadd($countyId)
     {
         //区县
        $model = new ComCounty();
        $models=ComCounty::find()->where(['isValid'=>'1'])->all();

         //商圈类
        $ComBusinessDistrict=new ComBusinessDistrict();

         //商圈的添加部分
         //商圈
         if ($ComBusinessDistrict->load(Yii::$app->request->post())) {
              if ($ComBusinessDistrict->validate()) {
                
                  if ($model->load(Yii::$app->request->post())) {
                    //获取下拉框的值
                      $countyId=(int)$model->countyName;
                      $ComBusinessDistrict->countyId=$countyId;
                    }
                    $ComBusinessDistrict->isValid='1';
                    $ComBusinessDistrict->save();

                    $message=$ComBusinessDistrict->getErrors();
                    $message["success"]=True;
                    return json_encode($message);
               
           }
           else{
                $message=$ComBusinessDistrict->getErrors();
                $message["success"]=False;
                return json_encode($message);
           }
                    
         }
         else{
                $ComBusinessDistrict->countyId=$countyId;
                $ComBusinessDistrict->isValid='1';
                 return  $this->renderPartial('businessdistrictcreate',[
                                 'ComBusinessDistrict'=>$ComBusinessDistrict,'model' => $model,'models'=>$models,
                            
                                 ]) ;
            }
     }




}
