<?php
/**
 * Created by PhpStorm.
 * User: pan
 * Date: 2015/1/9
 * Time: 9:50
 */
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

use common\hycommon\tool\HttpTool;


/**
 * Site controller
 */
class OrderController extends Controller
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
    public function actionConfirm()
    {
        $num = Yii::$app->request->get('number') ;//type goods 商品搜索 shop  为店铺搜索
        $goodsID = Yii::$app->request->get('goodsID') ;
        //$model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        $model =  "";
        return $this->render('orderConfirm', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionDetail()
    {
        $type = Yii::$app->request->get('type') ;//type goods 商品搜索 shop  为店铺搜索
        $searchWorld = Yii::$app->request->get('searchWorld') ;
        if($type=='goods' && !empty($searchWorld)){
            $model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        if($type=='shop' && !empty($searchWorld)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        $model = '';
        return $this->render('orderDetails', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionMyOrders()
    {
        $type = Yii::$app->request->get('type') ;//type goods 商品搜索 shop  为店铺搜索
        $searchWorld = Yii::$app->request->get('searchWorld') ;
        if($type=='goods' && !empty($searchWorld)){
            $model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        if($type=='shop' && !empty($searchWorld)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        $model = '';
        return $this->render('myOrders', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionChosePayment()
    {
        $type = Yii::$app->request->get('type') ;//type goods 商品搜索 shop  为店铺搜索
        $searchWorld = Yii::$app->request->get('searchWorld') ;
        if($type=='goods' && !empty($searchWorld)){
            $model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        if($type=='shop' && !empty($searchWorld)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        $model = '';
        return $this->render('chosePayment', [
            'model' => $model
        ]);
    }

    /**
     * @return string
     */
    public function actionPayment()
    {
        $type = Yii::$app->request->get('type') ;//type goods 商品搜索 shop  为店铺搜索
        $searchWorld = Yii::$app->request->get('searchWorld') ;
        if($type=='goods' && !empty($searchWorld)){
            $model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        if($type=='shop' && !empty($searchWorld)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        $model = '';
        return $this->render('paymentRusult', [
            'model' => $model
        ]);
    }


}
