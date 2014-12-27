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

 /**
  * 页面布局嵌套
  * @author xuwei <wxu@huayancreate.com>
  * @version 1.0
 */

class SigninActionController extends Controller
{

	public function phoneCaptcha()
	{
		$resultModel = new ResultModel();
		return json_encode($ResultModel);
	}

	public function signin()
	{
		//获取post数据
		//
		//验证post数据
		//
	}
}
?>