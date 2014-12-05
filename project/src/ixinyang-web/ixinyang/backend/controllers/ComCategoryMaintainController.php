<?php

namespace backend\controllers;

use Yii;
use backend\models\ComCategoryMaintain;
use backend\models\ComCategoryMaintainSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComCategoryMaintainController implements the CRUD actions for ComCategoryMaintain model.
 */
class ComCategoryMaintainController extends Controller
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
     * Lists all ComCategoryMaintain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComCategoryMaintainSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComCategoryMaintain model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $category = ComCategoryMaintain::find()->where(['id' => $model->parentCategoryId])->one();
        if($category == null)
        {
            $category = new ComCategoryMaintain();
            $category->categoryName='无';
        }
        return $this->renderPartial('view', [
            'model' => $model,
            'category'=>$category,
        ]);
    }

    /**
     * Creates a new ComCategoryMaintain model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComCategoryMaintain();
        $category = new ComCategoryMaintain();
        $category->categoryName="";

        $model->isValid = '1';
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            //print_r($categoryModel);
            return $this->renderPartial('create', [
                'model' => $model,
                'category'=>$category,
            ]);
        }
    }

    /**
     * Updates an existing ComCategoryMaintain model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        date_default_timezone_set('PRC');
        $tempDate=date("Y-m-d H:i:s");
        $model->updateTime=$tempDate;
        $model->isValid='1';

        $category = ComCategoryMaintain::find()->where(['id' => $model->parentCategoryId])->one();
        if($category == null)
        {
            $category = new ComCategoryMaintain();
            $category->categoryName='';
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderPartial
            ('update', [
                'model' => $model, 'category'=>$category,
            ]);
        }
    }

    /**
     * Deletes an existing ComCategoryMaintain model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->isValid="0";
        $model->save();
        //$this->findModel($id)->delete();

       // return $this->redirect(['index']);
    }


    public function actionCategory()
    {
        $category = ComCategoryMaintain::find()->where(['isValid'=>1,'categoryType'=>2])->asArray()->all();
        return json_encode($category);

    }
    /**
     * Finds the ComCategoryMaintain model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComCategoryMaintain the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComCategoryMaintain::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
