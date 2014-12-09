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
    public function actionIndex()
    {
        //初始进入主页时 设置默认值 查询所有 0->无效 1->有效 2->全部
        $model = new ComMenu();
        $model->isValid=2;
        return $this->render('index', [
            'model' => $model,
        ]);
        
    }

     /**
     * Lists all ComMenu models.
     * @return mixed
     */
    public function actionSearch()
    {
        $isValid=$_POST["isValid"];
        $model = new ComMenu();
        $model->isValid=$isValid;
        return $this->renderPartial('search', [
            'model' => $model,
        ]);
        
    }


    public function actionAdd($id)
    {
        $model = new ComMenu();
        if ($model->load(Yii::$app->request->post())) {
              if ($model->validate()) {
                      $parentMenuIdHdn=$_POST["parentMenuIdHdn"];
                      $model->parentMenuId=$parentMenuIdHdn;
                      $model->createTime=date("Y-m-d H:i:s");
                      $model->save();

                      //数据验证成功
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
        else{
                $model->isValid='1';
                $model->id=$id;
                return $this->renderPartial('add',['model'=>$model]); 
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
     * Updates an existing ComMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);   

        if ($model->load(Yii::$app->request->post()) ) {
          if ($model->validate()) {

             $model->updateTime=date("Y-m-d H:i:s");
             $model->save();
              //数据验证成功
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
        else {
             $model->id=$id;
            return $this->renderPartial('update', [
                'model' => $model,
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
         $commenu=new ComMenu();
         //删除菜单
         $commenu->deleteMenu($model,$id);
         $model->isValid=$isValid;

         return $this->render('index', [
                'model' => $model,
            ]);
    }
    //激活菜单
    public function actionActive($id,$isValid)
    {
        $model = new ComMenu();
        //激活菜单
        $model->activeMenu($id);
        
        $model->isValid=$isValid;

        return $this->render('index', [
                'model' => $model,
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
