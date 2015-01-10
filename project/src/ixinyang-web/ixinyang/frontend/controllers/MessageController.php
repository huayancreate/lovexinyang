<?php
namespace frontend\controllers;

use Yii;
use frontend\models\LoginForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\models\CusUserAccount;
use common\hycommon\tool\GenerateValidateCode;
use common\hycommon\tool\SendPhoneSMS;
use common\hycommon\tool\HttpTool;

use yii\web\Session;

/**
 * Site controller
 */
class MessageController extends Controller
{



    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['getmsg'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

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

    /**
     * @return string
     */
    public function actionGetmsg()
    {
        $session = Yii::$app->getSession();
        $session->open();
        if($session['user']!==null){
            $msgObject = HttpTool::post_data('AdvAction','{"opeType":"getBannerList","type":"0"}');
        }
        $msgObject = '[{"msgid":1,"content":"你好，这是第一次测试的信息"},
        {"msgid":2,"content":"你好，这是第二条测试的信息"}]';
        return $msgObject;
    }

}
