<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use common\hycommon\tool\HttpTool;


/**
 * detail controller
 */
class DetailController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [

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
    public function actionIndex()
    {
        $goodsID = Yii::$app->request->get('goodsID') ;
        $model = '';
        if(!empty($goodsID)){
            $model = HttpTool::post_data('getDetils','{"opeType":"getDetils","goodsID":"' + $goodsID +'"}');
        }
        return $this->render('goodsDetail', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionShop()
    {
        $shopID = Yii::$app->request->get('shopID') ;
        $model = '';
        if( !empty($shopId)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getDetils","shopID":"' + $shopID +'"}');
        }
        return $this->render('businessDetail', [
            'model' => $model
        ]);
    }

}
