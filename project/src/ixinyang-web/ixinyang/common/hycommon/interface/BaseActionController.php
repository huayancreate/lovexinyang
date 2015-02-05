<?php
/**
  * @link http://www.huayancreate.com/
  * @copyright Copyright (c) 2014 HuaYan
  * @license http://www.huayancreate.com/license/
*/

namespace hy\common\interface;


use Yii;
use yii\web\Controller;
use hy\common\model\SigninModel;
use hy\common\model\ResultModel;
use backend\models\ComCategoryMaintain;

 /**
  * @author xuwei <wxu@huayancreate.com>
  * @version 1.0
  *
  *
  * @return  
  *  [{"success":"true",
  *  	"content":
  *     {
  *     "recordList":
  *     [ 
  *     {
  *        "ID" : "value",
  *        "parentCategoryId" : "value", (父类别)
  *        "categoryCode": "value",  (类别编码)
  *        "categoryGrade": "value",  (类别等级)
  *        "categoryName" : "value",  (类别名称)
  *        "categoryType" : "value",  (类别类型)
  *      },
  *     {
  *        "ID" : "value",
  *        "parentCategoryId" : "value", (父类别)
  *        "categoryCode": "value",  (类别编码)
  *        "categoryGrade": "value",  (类别等级)
  *        "categoryName" : "value",  (类别名称)
  *        "categoryType" : "value",  (类别类型)
  *      },
  *      ],
  *      }
  *  }]
  * 
 */



class BaseActionController extends BaseController
{
	public $functionName = ['getType' => 'getType', 'getRegion' => 'getRegion'];

	public function getType()
	{
		$resultModel = new ResultModel();
		$resultModel->success = true;
		$model = new ComCategoryMaintain();
		if(Yii::$app->request->isPost())
		{
			$type = $_POST["type"];
			$recordList = $model->getCategoryByType($type)
			sendResponse($resultModel);
		}
	}

	public function getRegion()
	{
		$resultModel = new ResultModel();
		sendResponse($resultModel);
	}
}
?>