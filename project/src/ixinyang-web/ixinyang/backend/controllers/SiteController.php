<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\LoginForm;
use backend\models\TMenu;
use backend\models\TAdmUser;
use yii\caching\ChainedDependency;
use yii\caching\ExpressionDependency;
use yii\caching\DbDependency;
use yii\log\Logger;


/**
 * Site controller
 */
class SiteController extends BackendController
{
    

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout="login";

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->rememberMe = Yii::$app->request->post('rememberMe')?:false;
            if( $model->login()){
                $key = '_menu'.Yii::$app->user->id;
                if(Yii::$app->session->getFlash('reflush') || !Yii::$app->cache->get($key))
                {
                    $dp = new ExpressionDependency([
                        'expression'=>'count(Yii::$app->authManager->getPermissionsByUser(Yii::$app->user->id))'
                    ]);
                    $dp2 = new DbDependency([
                        'sql'=>'select max(updated_at) from auth_item',
                    ]);
                    Yii::$app->cache->set($key,'nothing',0,new ChainedDependency([
                        'dependencies'=>[$dp,$dp2]
                    ]));
                    $_list = TMenu::generateMenuByUser();
                    Yii::$app->cache->set('menulist-'.Yii::$app->user->id,$_list,0);
                }
                
                return $this->goBack();
            }
        } 
        return $this->render('login', ['model' => $model,]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['login']);
    }
}
