<?php
/**
  * @link http://www.huayancreate.com/
  * @copyright Copyright (c) 2014 HuaYan
  * @license http://www.huayancreate.com/license/
*/

namespace hy\model;

use Yii;
use yii\base\Widget;

 /**
  * 全局的user接口
  * 在任意时刻，你可以通过 
  * @author xuwei <wxu@huayancreate.com>
  * @version 1.0
 */

interface iUser
{
	/*
		
	 */
    public function login($username, $password, $type);
    public function logout();
    public function getPermission($token);
    public function getMenus();
    public function getHtml($template);
}
?>