<?php

namespace backend\controllers;

use backend\models\AuthItem;
use backend\models\TAdmUser;
use backend\models\TMenu;
use backend\models\AuthRule;
use Yii;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\MethodNotAllowedHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\AuthAssignment;
use backend\models\AuthItemChild;

/**
 * Description of RbacController
 *
 * @author Administrator
 */
class RbacController extends BackendController {

    /**
     * 角色列表
     * @return string
     */
    public function actionRoles() {
        $roles = Yii::$app->authManager->getRoles();
        $dataprovider = new ArrayDataProvider([
            'allModels' => $roles,
        ]);
        return $this->render('roles', [
                    'dataprovider' => $dataprovider,
        ]);
    }

    /**
     * 添加/修改角色
     * @return string
     */
    public function actionManagerole() {
        if ($roleId = $_REQUEST['id']) {
            $model = AuthItem::findOne($roleId);
        } else {
            $model = new AuthItem();
        }

        if (Yii::$app->request->isPost) {
            $auth = Yii::$app->authManager;
            $model->load(Yii::$app->request->post());
            if ($model->isNewRecord) {
                $role = $auth->createRole($model->name);
                $role->description = $model->description;
                $rzt = $auth->add($role);
            } else {
                $name = $model->oldAttributes['name'];
                $role = $auth->getRole($name);
                $role->name = $model->name;
                $role->description = $model->description;
                $rzt = $auth->update($name, $role);
                
                print_r($model->name);
                print_r($name);
                //修改角色授权信息
                AuthAssignment::updateAll(['item_name'=> $model->name],
                        ['item_name'=> $name]);
                //修改菜单授权
                AuthItemChild::updateAll(['parent'=>$model->name],
                        ['parent'=>$name]);
            }
            if ($rzt) {
                Yii::$app->session->setFlash('success', "操作成功！");
                return $this->redirect(['roles']);
            }
        }
        return $this->render('addrole', [
                    'model' => $model,
        ]);
    }

    /**
     * 删除角色
     * @param $id
     * @return Response
     */
    public function actionDeleterole($id) {
        $role = Yii::$app->authManager->getRole($id);
        
        //判断是否已授权
        $assignment = AuthAssignment::find()
                        ->where(['item_name' => $role->name])->all();

        if ($assignment != null) {
            Yii::$app->session->setFlash('error', "<b>".$role->name.'</b> 已授权，不可删除！');
        } else {

            if (Yii::$app->authManager->remove($role)) {
                Yii::$app->session->setFlash('success', '删除成功！');
            } else {
                Yii::$app->session->setFlash('error', '角色删除失败');
            }
        }
        return $this->redirect(['rbac/roles']);
    }

    /**
     * ajax验证角色是否存在
     * @return array
     */
    public function actionValidateitemname() {
        if ($name = $_REQUEST['id']){
            $model = AuthItem::findOne($name);
        }else{
            $model = new AuthItem();
        }
        if (Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * 给角色分配权限
     * @return string
     */
    public function actionAssignauth() {
        if (Yii::$app->request->isPost) {
            $posts = Yii::$app->request->post();
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($posts['rolename']);
            $thismenu = TMenu::findOne($posts['menuid']);
            $route = $thismenu->route;
            $permission = $auth->getPermission($route);
            if ($posts['ck'] == 'true') {
                if ($thismenu->father != "") {  //当勾选子级时 插入父级菜单 
                    $fpermission = $auth->getPermission($thismenu->father->route);

                    $this->addChild($role, $fpermission);
                }
                $children = $thismenu->son;
                foreach ($children as $son) {
                    $this->addChild($role, $auth->getPermission($son->route));
                }
                //自身加入权限
                $auth->addChild($role, $permission); //插入当前勾选
            } else {
                foreach ($thismenu->son as $son) {
                    $auth->removeChild($role, $auth->getPermission($son->route));
                }
                //删除自身
                $auth->removeChild($role, $permission);
            }
        }

        $tmenu = new TMenu();
        $list = TMenu::find()->asArray()->all();

        $getRoleName = Yii::$app->request->get('rolename');
        $postRoleName = Yii::$app->request->post('rolename');

        $rolename = $getRoleName == "" ? $postRoleName : $getRoleName; //如果是get提交则取get值，否则取post

        return $this->render('assignauth', [
                    'list' => $tmenu->getTree($list, 0),
                    'rolename' => $rolename,
                    'role' => Yii::$app->authManager->getRole($rolename),
                    'model' => AuthItem::findOne($rolename),
        ]);
    }

    /**
     * 给用户分配角色
     * @param $id
     * @return string
     */
    public function actionAssignrole($id) {
        $auth = Yii::$app->authManager;
        $model = TAdmUser::findOne($id);

        if (Yii::$app->request->isPost) {
            $action = Yii::$app->request->get('action');
            $roles = Yii::$app->request->post('roles');
            if ($action == 'assign') {
                foreach ($roles as $rolename) {
                    $role = $auth->getRole($rolename);
                    $auth->assign($role, $id);
                }
            } else {
                foreach ($roles as $rolename) {
                    $role = $auth->getRole($rolename);
                    $auth->revoke($role, $id);
                }
            }
            //所有角色
            $allroles = ArrayHelper::map($auth->getRoles(), 'name', 'name');
            //所有已选择的角色
            $selectedroles = ArrayHelper::map($auth->getRolesByUser($id), 'name', 'name');
            $res = [
                Html::renderSelectOptions('', array_diff($allroles, $selectedroles)),
                Html::renderSelectOptions('', $selectedroles)
            ];
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $res;
        }
        //获取已有角色
        $assignedroles = ArrayHelper::map($auth->getRolesByUser($id), 'name', 'name');
        //获取所有角色
        $allroles = ArrayHelper::map($auth->getRoles(), 'name', 'name');
        //未被选择的角色
        $roles = array_diff($allroles, $assignedroles);

        return $this->render('assignrole', [
                    'roles' => $roles,
                    'assignedroles' => $assignedroles,
                    'model' => $model,
                    'id' => $id
        ]);
    }

    /**
     * 添加权限
     * @param $role
     * @param $item
     */
    protected function addChild($role, $item) {
        $auth = Yii::$app->authManager;
        if (!$auth->hasChild($role, $item))
            $auth->addChild($role, $item);
    }

}
