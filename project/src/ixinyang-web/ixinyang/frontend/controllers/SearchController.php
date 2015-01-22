<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

use common\hycommon\tool\HttpTool;

use yii\web\Session;

/**
 * Site controller
 */
class SearchController extends Controller
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
        $type = Yii::$app->request->post('type') ;//type goods 商品搜索 shop  为店铺搜索
        $searchWorld = Yii::$app->request->post('searchWorld') ;
        $response = 'search';
        if($type=='goods' && !empty($searchWorld)){
            $model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        if($type=='shop' && !empty($searchWorld)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
            $response = 'businessSearch';
        }
        $model = json_decode('[{"goodsID":1,"shopImg":"images/food01.jpg","name":"科颜氏黄瓜植物精华爽肤水 250ml","des":"护肤之行，始于补水！科颜氏黄瓜植物精华爽肤水 250ml，水到沁出来！","discountPrice":"40","salesNum":"300",
        "price":"56","path":"http://sh.jumei.com/i/deal/d150103p21879zc.html?from=index_hotdeals3_pos166_d3_onsale_new"},
        {"goodsID":1,"shopImg":"images/food01.jpg","name":"科颜氏黄瓜植物精华爽肤水 250ml","des":"护肤之行，始于补水！科颜氏黄瓜植物精华爽肤水 250ml，水到沁出来！","discountPrice":"40","salesNum":"300",
        "price":"56","path":"http://sh.jumei.com/i/deal/d150103p21879zc.html?from=index_hotdeals3_pos166_d3_onsale_new"},
        {"goodsID":1,"shopImg":"images/food01.jpg","name":"科颜氏黄瓜植物精华爽肤水 250ml","des":"护肤之行，始于补水！科颜氏黄瓜植物精华爽肤水 250ml，水到沁出来！","discountPrice":"40","salesNum":"300",
        "price":"56","path":"http://sh.jumei.com/i/deal/d150103p21879zc.html?from=index_hotdeals3_pos166_d3_onsale_new"},
        {"goodsID":1,"shopImg":"images/food01.jpg","name":"科颜氏黄瓜植物精华爽肤水 250ml","des":"护肤之行，始于补水！科颜氏黄瓜植物精华爽肤水 250ml，水到沁出来！","discountPrice":"40","salesNum":"300",
        "price":"56","path":"http://sh.jumei.com/i/deal/d150103p21879zc.html?from=index_hotdeals3_pos166_d3_onsale_new"},
        {"goodsID":1,"shopImg":"images/food01.jpg","name":"科颜氏黄瓜植物精华爽肤水 250ml","des":"护肤之行，始于补水！科颜氏黄瓜植物精华爽肤水 250ml，水到沁出来！","discountPrice":"40","salesNum":"300",
        "price":"56","path":"http://sh.jumei.com/i/deal/d150103p21879zc.html?from=index_hotdeals3_pos166_d3_onsale_new"},
        {"goodsID":1,"shopImg":"images/food01.jpg","name":"科颜氏黄瓜植物精华爽肤水 250ml","des":"护肤之行，始于补水！科颜氏黄瓜植物精华爽肤水 250ml，水到沁出来！","discountPrice":"40","salesNum":"300",
        "price":"56","path":"http://sh.jumei.com/i/deal/d150103p21879zc.html?from=index_hotdeals3_pos166_d3_onsale_new"}]');
        return $this->render($response, [
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
        $response = 'goodsDetail';
        if($type=='goods' && !empty($searchWorld)){
            $model = HttpTool::post_data('GoodsAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
        }
        if($type=='shop' && !empty($searchWorld)){
            $model = HttpTool::post_data('ShopAction','{"opeType":"getList","searchString":"' + $searchWorld +'"}');
            $response = 'businessDetail';
        }
        $model = '';
        return $this->render($response, [
            'model' => $model
        ]);
    }

}
