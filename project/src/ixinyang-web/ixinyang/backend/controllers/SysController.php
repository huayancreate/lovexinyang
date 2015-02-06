<?php

namespace backend\controllers;

use kartik\widgets\ActiveForm;
use Yii;
use backend\models\TMenu;
use yii\web\Response;
use yii\helpers\Json;


class SysController extends BackendController {

    /**
     * 菜单管理
     * @return string
     */
    public function actionMenu() {
        $model = new TMenu();

        $list = TMenu::find()->asArray()->all();
        return $this->render('menu', [
                    'list' => $model->getTree($list, 0),
        ]);
    }

    /*
     * 添加/修改菜单
     */

    public function actionMenumange() {
        $model = new TMenu();

        if (Yii::$app->request->isPost) {
            $params = Yii::$app->request->post();

            $id = $params['TMenu']['id'];
            if ($id > 0) {
                $model = TMenu::findOne($id);
            }

            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                //Yii::$app->session->setFlash('success');
                return $this->redirect(['sys/menu']);
            }
        } else {
            $params = Yii::$app->request->get();

            $id = $params['id'];
            if ($id > 0) {
                $model = TMenu::findOne($id);
            } else {
                $model->loadDefaultValues();
                $model->parentid = $params['pid'];
            }
        }

        $tmenu = TMenu::find();
        return $this->render('menumange', [
                    'model' => $model,
                    'menuFather' => $tmenu->where(['parentid' => 0])->all(),
                    'menuSon' => TMenu::find()->where(['parentid' => $model->parentid])->all()
        ]);
    }

    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = self::getSubCatList($cat_id);

                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    private function getSubCatList($pid) {
        return TMenu::find()->where(['parentid' => $pid])->asArray()->all();
    }

    public function actionMenudel() {
        $id = Yii::$app->request->get('id');

        $model = TMenu::findOne($id);
        //判断是否存在子级。
        $_list = TMenu::find()->where(['parentid' => $id])->all();
        if (count($_list) > 0) {
            Yii::$app->session->setFlash('error', "存在子级菜单，不可删除！");
            //echo \Yii::t('app', 'I am a message!');
        } else {
            //读取auth_item_child判断是否已被授权如果授权则不能删除
            $authItemChild = \backend\models\AuthItemChild::find()
                            ->where(['child' => $model->route])->all();
            print_r($authItemChild);
            if (count($authItemChild) > 0) {
                 Yii::$app->session->setFlash('error', "该菜单已被授权，不可删除！");
            } else {
                TMenu::findOne($id)->delete();
                Yii::$app->session->setFlash('success', "操作成功");
            }
        }
        return $this->redirect(['sys/menu']);
    }

    /**
     * Ajax 验证菜单名称
     * @return array
     */
    public function actionAjaxvalidate() {
        if ($id = Yii::$app->request->post('id')) {
            $model = TMenu::findOne($id);
        } else {
            $model = new TMenu();
            if (Yii::$app->request->isAjax) {
                $model->load(Yii::$app->request->post());
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ActiveForm::validate($model, 'name');
            }
        }
    }

}
