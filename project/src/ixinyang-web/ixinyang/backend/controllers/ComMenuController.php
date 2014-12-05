<?php

namespace backend\controllers;

use Yii;
use backend\models\ComMenu;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComMenuController implements the CRUD actions for ComMenu model.
 */
class ComMenuController extends Controller
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
     * Lists all ComMenu models.
     * @return mixed
     */
    public function actionIndex($isValid)
    {
        $model = new ComMenu();
        return $this->render('index', [
            'model' => $model,'isValid'=>$isValid,
        ]);
        
    }

    public function actionReload($id,$isValid)
    {
        $model = new ComMenu();
        if ($model->load(Yii::$app->request->post())) {
          $parentMenuIdHdn=$_POST["parentMenuIdHdn"];
          $model->parentMenuId=$parentMenuIdHdn;
          $model->isValid='1';
          $model->createTime=date("Y-m-d H:i:s");
          $model->save();
            return $this->render('index', [
                'model' => $model,'id'=>$id,'isValid'=>$isValid,
            ]);
        }
        else{
           return $this->renderPartial('reload',['model'=>$model,'id'=>$id]); 
        }
        
    }

    /**
     * Displays a single ComMenu model.
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
     * Creates a new ComMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id,$isValid)
    {
        
    }

    /**
     * Updates an existing ComMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id,$isValid)
    {
        $model = $this->findModel($id);   

        if ($model->load(Yii::$app->request->post()) ) {
             $model->updateTime=date("Y-m-d H:i:s");
             $model->save();
             $id=null;
             return $this->render('index', [
                      'model' => $model,'id'=>@$id,'isValid'=>$isValid,
                  ]);
        } 
        else {
            return $this->renderPartial('update', [
                'model' => $model,'id'=>@$id,
            ]);
        }
    }

    /**
     * Deletes an existing ComMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id,$isValid)
    {
        //$this->findModel($id)->delete();
         $model = $this->findModel($id);  
        
         if (  $model->parentMenuId=='1') {
            //一级菜单需要批量修改二级菜单 还有其本身
            $result=ComMenu::updateBySql('com_menu',['isValid'=>0,'updateTime'=>date("Y-m-d H:i:s")], ['parentMenuId' =>$id,'isValid'=>'1']);
           }
             //二级菜单的修改  只修改本身
             $model->updateTime=date("Y-m-d H:i:s");
             $model->isValid='0';
             $model->save();  
        
         $id=null;
         return $this->render('index', [
                'model' => $model,'id'=>$id,'isValid'=>$isValid,
            ]);
        
       
    }

    /**
     * Finds the ComMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}
