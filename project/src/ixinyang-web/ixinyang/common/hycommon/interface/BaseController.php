<?php
/**
  * @link http://www.huayancreate.com/
  * @copyright Copyright (c) 2014 HuaYan
  * @license http://www.huayancreate.com/license/
*/

namespace hy\common\interface;


use Yii;
use yii\web\Controller;

 /**
  * @author xuwei <wxu@huayancreate.com>
  * @version 1.0
 */

class BaseController extends Controller
{
	public $functionName = [];

	public function actionIndex()
	{
		$opeType = Yii::$app->request->post('opeType');
		if(is_callable($opeType, true))
		{
			call_user_func($opeType);
		}else
		{
			throw new InvalidParamException('No method!');
		}
	}

	public function sendResponse($result)
	{
		return json_encode($result);
	}
}
?>