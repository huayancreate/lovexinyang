<?php
namespace common\hycommon\tool;

use Yii;
/**
 * Created by PhpStorm.
 * User: pan
 * Date: 2014/12/14
 * Time: 18:01
 */
class SendPhoneSMS
{
    public  $apikey = "f5d6ccd78a9426a28e244c97a141e969 "; //Yii::$app->$GLOBALS['apikey'];// params['apikey'];

    /**
     * url 为服务的url地址
     * query 为请求串
     */
    function sock_post($url, $query)
    {
        $data = "";
        $info = parse_url($url);
        $fp = fsockopen($info["host"], 80, $errno, $errstr, 30);
        if (!$fp) {
            return $data;
        }
        $head = "POST " . $info['path'] . " HTTP/1.0\r\n";
        $head .= "Host: " . $info['host'] . "\r\n";
        $head .= "Referer: http://" . $info['host'] . $info['path'] . "\r\n";
        $head .= "Content-type: application/x-www-form-urlencoded\r\n";
        $head .= "Content-Length: " . strlen(trim($query)) . "\r\n";
        $head .= "\r\n";
        $head .= trim($query);
        $write = fputs($fp, $head);
        $header = "";
        while ($str = trim(fgets($fp, 4096))) {
            $header .= $str;
        }
        while (!feof($fp)) {
            $data .= fgets($fp, 4096);
        }
        return $data;
    }

    /**
     * 模板接口发短信
     * apikey 为云片分配的apikey
     * tpl_id 为模板id
     * tpl_value 为模板值
     * mobile 为接受短信的手机号
     */
    function tpl_send_sms( $tpl_id, $tpl_value, $mobile,$session)
    {
        $url = "http://yunpian.com/v1/sms/tpl_send.json";
        $encoded_tpl_value = urlencode("$tpl_value");
        $post_string = "apikey=$this->apikey&tpl_id=$tpl_id&tpl_value=$encoded_tpl_value&mobile=$mobile";
         $data = json_decode( $this->sock_post($url, $post_string)) ;
        //$data = json_decode('{"code": 0,"msg": "OK"}');
        $result = $data!=null && $data->code === 0 ?true : false;
        Yii::error($data);
        if($result){
            $session['SMS_phone'] = $mobile;
            $session['SMS_time'] = date("Y-m-d H:i:s");
            $session['__validateCode_count'] +=  1;
        }
        return $result;
    }

    /**
     * 模板接口发短信
     * apikey 为云片分配的apikey
     * tpl_id 为模板id
     * tpl_value 为模板值
     * mobile 为接受短信的手机号
     */
    function send_sms_action($mobile,$sign)
    {
        $validate = new GenerateValidateCode();
        $session = Yii::$app->getSession();
        $session->open();
        if($session['SMS_phone']!=null && $session['SMS_phone'] === $mobile && strtotime($session['SMS_time']) > strtotime(date("Y-m-d H:i:s", strtotime("-1 minute"))) ){
            $array["result"] = false;
            $array["msg"] = '操作过于频繁，请1分钟后重试';
        }else{
            $code = $validate ->getNumberCode(true,6);
            if($sign===null|| $sign ===''){
                $sign = 5;
                $tplvalue = "#app#=".C_APP."&#code#=$code&#company#=".C_COMPANY;
            }elseif($sign === 'findPassword'){
                $sign = 7;
                $tplvalue = "#code#=$code&#company#=".C_COMPANY;
            }
            $array["result"] =  $this->tpl_send_sms($sign,$tplvalue,$mobile,$session);
            $array["count"] = $session[$validate->name . '_count'];
        }
        return $array;
    }

    /**
     * 普通接口发短信
     * apikey 为云片分配的apikey
     * text 为短信内容
     * mobile 为接受短信的手机号
     */
    function send_sms($apikey, $text, $mobile)
    {
        $url = "http://yunpian.com/v1/sms/send.json";
        $encoded_text = urlencode("$text");
        $post_string = "apikey=$apikey&text=$encoded_text&mobile=$mobile";
        return $this->sock_post($url, $post_string);
    }



}