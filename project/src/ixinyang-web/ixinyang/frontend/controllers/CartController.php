<?php
/**
 * Created by PhpStorm.
 * User: pan
 * Date: 2015/1/9
 * Time: 9:48
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use common\hycommon\tool\HttpTool;


/**
 * detail controller
 */
class CartController extends Controller
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
        return $this->render('cart', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionAdd()
    {
        $goodsID = Yii::$app->request->get('gid') ;
        $num = Yii::$app->request->get('number')+1 ;
        $model = '';
        if(!empty($goodsID)){
            $model = HttpTool::post_data('getDetils','{"opeType":"getDetils","goodsID":"' + $goodsID +'"}');
        }
        $model = '{"type":"success","cart_item_number":"'.$num.'"}';
        return $model;
    }

}
