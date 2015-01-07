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
        $category = $model->getCategoryByParentId($model->parentCategoryId);
        if ($category == null) {
            $category = new ComCategoryMaintain();
            $category->categoryName = '无';
        }
        return $this->renderPartial('view', [
            'model' => $model,
            'category' => $category,
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

        if ($model->load(Yii::$app->request->post())) {
            $model->saveCategory();
            return count($model->getErrors()) > 0 ? '{"msg":"error"}' : '{"msg":"success"}';
        } else {
            //$category = $model->getAllCategory();
            return $this->renderPartial('create', [
                'model' => $model,
                'category' => $category,
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

        $category = $model->getCategoryByParentId($model->parentCategoryId);
        if ($category == null) {
            $category = new ComCategoryMaintain();
            $category->categoryName = '';
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->updateCategory();
            return count($model->getErrors()) > 0 ? '{"msg":"error"}' : '{"msg":"success"}';
        } else {
            return $this->renderPartial('update', [
                'model' => $model, 'category' => $category,
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
        $model->deleteCategory();
    }

    public function actionCategory()
    {
        $type = $_GET["type"];
        $model = new ComCategoryMaintain();
        //$category = ComCategoryMaintain::find()->where(['isValid' => 1, 'categoryType' => $type])->asArray()->all();
        return json_encode($model->getCategoryByType($type));
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

    public function actionData()
    {
        $model = new ComCategoryMaintain();
        $arr = $model->find()->asArray()->all();
        return json_encode($arr);
    }

    public function actionGrade()
    {
        if (Yii::$app->request->post()) {
            $id = $_POST["id"];
            $model = $this->findModel($id);
            return $model->categoryGrade;
        }
    }
}
