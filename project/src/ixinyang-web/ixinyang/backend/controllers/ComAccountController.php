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
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComAccountController implements the CRUD actions for ComAccount model.
 */
class ComAccountController extends Controller
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
        $relation = ComPersonRolerelation::find()->where(['personId' => $id])->one();
        $mRole = ComRole::find()->where(['id' => $relation->roleId])->one();
        if ($mRole == null) {
            $mRole =  new ComRole();
            $mRole->roleName = '无';
        } else {
            if ($mRole->isValid == 0) {
                $mRole->roleName = '';
            }
        }
        return $this->renderPartial('view', [
            'model' => $this->findModel($id), 'role' => $mRole
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
        $roles = ComRole::findBySql('SELECT * FROM com_role where isValid=1 ')->all();
        $role = new ComRole();
        $rolerelation = new ComPersonRolerelation();
        $model->sex = '男';

        $searchModel = new ComAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {

            date_default_timezone_set('PRC');
            $model->createTime = date("Y-m-d H:i:s");
            $model->updateTime = date("Y-m-d H:i:s");
            $model->password = '123456';
            $model->isFirstLogin = '1';
            $model->accountStatus = 1;

            $rolerelation->updateTime = date("Y-m-d H:i:s");
            $rolerelation->isValid = '1';
            $rolerelation->accountType = 1;

            if ($role->load(Yii::$app->request->post())) {
                $mId = (int)$role->roleName;
                $rolerelation->roleId = $mId;
            }

            if ($model->save()) {
                $rolerelation->personId = $model['id'];
                if ($rolerelation->save()) {
//                    return $this->redirect(['create',
//                    'model' => $model,
//                    'searchModel' => $searchModel,
//                    'dataProvider' => $dataProvider,
//                    'roles'=>$roles,
//                    'role'=>$role,
//                    ]);
                }
            } else {
                return $this->renderPartial('create', [
                    'model' => $model,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'roles' => $roles,
                    'role' => $role,
                ]);
            }
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'roles' => $roles,
                'role' => $role,
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
        $model = $this->findModel($id);
        $roles = ComRole::findBySql('SELECT * FROM com_role where isValid=1 ')->all();
        $role = new ComRole();
        $roleRelation = ComPersonRolerelation::find()->where(['personId' => $model->id])->one();
        if ($roleRelation != null) {
            $myRole = ComRole::find()->where(['id' => $roleRelation->roleId])->one();
            $roleId = $roleRelation->roleId;
            if ($myRole != null) {
                if ($myRole->isValid == 0) {
                    $roleId = 0;
                }
            }
        }
        if ($role->load(Yii::$app->request->post())) {
            $mId = (int)$role->roleName;
            $roleRelation->roleId = $mId;
        }
        if ($role == null) {
            $role = new ComRole();
            $role->roleName = "";
        }
        if ($model->load(Yii::$app->request->post())) {
            date_default_timezone_set('PRC');
            $model->updateTime = date("Y-m-d H:i:s");
            $roleRelation->updateTime = date("Y-m-d H:i:s");

            if ($model->save() && $roleRelation->save()) {
                //return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->renderPartial('update', [
                    'model' => $model,
                    'roles' => $roles,
                    'role' => $role,
                    'roleId' => $roleId,
                ]);
            }
        } else {
            return $this->renderPartial('update', [
                'model' => $model,
                'roles' => $roles,
                'role' => $role,
                'roleId' => $roleId,
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
        $myModel = $this->findModel($id);
        date_default_timezone_set('PRC');
        $myModel->updateTime = date("Y-m-d H:i:s");
        $myModel->accountStatus = 0;
        if ($myModel->save()) {
            //return $this->redirect(['create']);
        }
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
}
