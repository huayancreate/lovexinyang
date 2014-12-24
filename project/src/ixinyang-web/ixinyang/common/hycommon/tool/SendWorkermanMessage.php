<?php
/**
 * Created by PhpStorm.
 * User: pan
 * Date: 2014/12/21
 * Time: 18:36
 */
namespace common\hycommon\tool;

require  'C:/Users/pan/Documents/GitHub/lovexinyang/project/src/ixinyang-workerman/applications/ixinyang-sender/Lib/Gateway.php';
use ElephantIO\Client,
    ElephantIO\Engine\SocketIO\Version1X;


class SendWorkermanMessage {

    public $url  = '';

    /**
     * @param $users  收件人
     * @param $msg    消息内容
     * @param $recipient  收件人类型（1、用户   2、商家）
     */
    function semdMessage($users,$msg,$recipient = 1){

        $this->sendto();
    }
} 