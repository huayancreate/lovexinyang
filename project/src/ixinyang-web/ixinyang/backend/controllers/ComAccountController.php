<?php
/**
 * Created by PhpStorm.
 * User: liuweiisme
 * Date: 2014-11-28
 * Time: 11:10
 */

namespace backend\controllers;

use Yii;
use backend\models\ComAccount;
use backend\models\ComAccountSearch;
use backend\models\ComRole;
use backend\models\ComPersonRolerelation;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\AuthItem;

/**
 * ComAccountController implements the CRUD actions for ComAccount model.
 */
class ComAccountController extends BackendController
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
     * Lists all ComCategoryMaintain models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComAccount model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $relationArr = ComPersonRolerelation::find()->where(['personId' => $id])->all();
        $roleName = "";
        foreach ($relationArr as $relation) {
            $mRole = ComRole::find()->where(['id' => $relation->roleId])->one();
            $roleName = $roleName . $mRole->roleName . ',';
        }
        $roleName = substr($roleName, 0, -1);//截取字符串最后一个‘,’字符
        return $this->renderPartial('view', [
            'model' => $this->findModel($id), 'role' => $roleName
        ]);
    }

    /**
     * Creates a new ComAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComAccount();
        $searchModel = new ComAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //$role = new ComRole();
        $role=new AuthItem();

        if ($model->load(Yii::$app->request->post())) {
            if ($role->load(Yii::$app->request->post())) {
                
                $roleIdArr = $this->stringInArray($role->roleName);
                $model->saveUserAccount($roleIdArr);
                //return count($model->getErrors()) > 0 ? '{"msg":"error"}' : '{"msg":"success"}';
                
                //print_r($model->getErrors());
                return $this->redirect(['index']);
            }

        } else {
            $model->sex = "男";
            $roles = $model->getAllRole();
            return $this->renderAjax('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'roles' => $roles,
                'role' => $role,
                'roleId' => 0,
            ]);
        }
    }


    /**
     * Updates an existing ComAccount model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel( $id);                
        $model->scenario='update';
        
        if ($model->load(Yii::$app->request->post())) {
            $model->updateTime=date("Y-m-d H:i:s");
            $model->save();
            return $this->redirect(['index']);

        } else {
           
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Deletes an existing ComAccount model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleteAccount($id);
    }

    /**
     * Finds the ComAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ComAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ComAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 字符串转换数组
     * @param  [type] $str [字符串 1,2,3,4,5,]
     * @return [type]      [description]
     */
    protected function stringInArray($str)
    {
        $str = substr($str, 0, -1);//截取字符串最后一个‘,’字符
        return explode(",", $str); //将字符转换成数组
    }

    public function actionUsername()
    {
        if (Yii::$app->request->post()) {
            $userName = $_POST["username"];
            $count = ComAccount::find()->where(['username' => $userName])->count();
            if ($count != 0) {
                return '{"msg": "当前账号已存在","err":"error"}';
            }
        }
        return "";
    }
}
