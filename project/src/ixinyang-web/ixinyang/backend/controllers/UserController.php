<?php

namespace backend\controllers;

use backend\models\AuthAssignment;
use backend\models\forsearch\TAdmUserSearch;
use Yii;
use backend\models\TAdmUser;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\SignupForm;

class UserController extends BackendController {
    /*
     * 用户管理
     */

    public function actionIndex() {
        $searchmodel = new TAdmUserSearch();
        $dataprovider = $searchmodel->search(Yii::$app->request->getQueryParams());
        return $this->render('index', [
                    'model' => new TAdmUser(['scenario' => 'create']),
                    'dataprovider' => $dataprovider,
                    //'searchmodel'=>$searchmodel,
        ]);
    }

    /**
     * 登陆
     * @return null|string
     */
    public function actionLogin() {
        $model = new TAdmUser();
        if (Yii::$app->request->isPost) {
            $model = new LoginForm($_POST);
            $model->rememberMe = Yii::$app->request->post('rememberMe')? : false;
            if ($model->login())
                return $this->goBack('/');
        }
        $this->layout = 'main-login';
        return $this->render('login', [
                    'model' => $model
        ]);
    }

    /**
     * 删除用户
     * @param $id
     * @return Response
     * @throws \Exception
     */
    public function actionDelete($id) {
        $model = TAdmUser::findOne($id);
        if ($model->delete()) {
            $assignment=new AuthAssignment();
            if($assignment->deleteAll(['user_id'=>$id])){

            }

            Yii::$app->session->setFlash('success', "操作成功");
        } else {
            Yii::$app->session->setFlash('error', '删除失败');
        }
        return $this->redirect(['user/index']);
    }

    /**
     * 登出
     * @return \yii\web\Response
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * 添加用户
     * @return null|string
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionAdduser() {
//        $model = new TAdmUser();
//        if (Yii::$app->request->isPost) {
//            $model->load($_POST);
//            if($model->validate() && $model->save(false)){
//                 Yii::$app->session->setFlash('success',"操作成功");
//            }else{
//                 Yii::$app->session->setFlash('error','添加失败');
//            }
//            return $this->redirect(['user/index']);
//        }
    }
    
    /**
     *  修改用户
     */
    public function actionUpdate(){
        
        if($id=Yii::$app->request->get('id')){
            $model = TAdmUser::findOne($id);
        }else{
            $model=new TAdmUser();
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionLoadhtml() {
        $model = new SignupForm();
        if($model->load(Yii::$app->request->post())){
            $user=$model->signup();
            if($user!=null){
                return $this->redirect(['user/index']);
            }else{
                Yii::$app->session->setFlash('error','添加失败！');
            }
        }
        return $this->render('loadhtml', [
            'model' => $model,
        ]);
    }

    /**
     * ajax验证是否存在
     * @return array
     */
    public function actionAjaxvalidate() {
        $model = new TAdmUser();
        if (Yii::$app->request->isAjax) {
            $model->load($_POST);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model, 'username');
        }
    }

    /**
     * 设置头像
     * @return string|Response
     * @throws \Exception
     */
    public function actionSetphoto() {
        $up = UploadedFile::getInstanceByName('photo');
        if ($up && !$up->getHasError()) {
            $userid = Yii::$app->user->id;
            $filename = $userid . '-' . date('YmdHis') . '.' . $up->getExtension();
            $path = Yii::getAlias('@backend/web/upload') . '/user/';
            FileHelper::createDirectory($path);
            $up->saveAs($path . $filename);
            $model = TAdmUser::findOne($userid);
            $oldphoto = $model->userphoto;
            $model->userphoto = $filename;
            if ($model->update()) {
                Yii::$app->session->setFlash('success');
                //删除旧头像
                if (is_file($path . $oldphoto))
                    unlink($path . $oldphoto);
                return $this->goHome();
            }else {
                print_r($model->getErrors());
                exit;
            }
        }
        return $this->render('setphoto', [
                    'preview' => Yii::$app->user->identity->userphoto,
        ]);
    }
    

    /**
     * 修改密码
     * @return string|Response
     */
    public function actionChangepwd($id) {

        $model=User::findOne($id);
        $model->password_hash=  Yii::$app->security->generatePasswordHash('123456');
        $model->generateAuthKey();
        if($model->save()){
            Yii::$app->session->setFlash('success','密码重置成功！新密码为：<b>'.$model->password_hash.'</b>');
        }else{
            Yii::$app->session->setFlash('error',"操作失败");
        }
       return $this->redirect(['user/index']);
    }
    
    

}