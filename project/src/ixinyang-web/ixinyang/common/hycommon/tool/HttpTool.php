<?php
namespace common\hycommon\tool;


/**
 * Created by PhpStorm.
 * User: pan
 * Date: 2015/1/4
 * Time: 12:02
 */
class HttpTool{


    function http_post_data($url, $data_string) {
        $ch = curl_init();
        //$data_string = "postJson="+$data_string;
        $timeout = 3000;
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Content-Length: ' . strlen($data_string))
        );
        //ob_start();
        $return_content = curl_exec($ch);
        $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if($return_code!=200){
            $return_code = null;
            Yii::error($return_code);
        }
        //$return_content = ob_get_contents();
        curl_close($url);
        //ob_end_clean();
        return  $return_content ; //array($return_code, $return_content);
    }

    function post_data($url,$data_string) {
        $url = C_BACKEND_SERVER_URL.$url;
        //$return_content = $this->http_post_data($url,$data_string);
        $return_content = '{"success":true,"content":{"recordList":[{"type":0,"ID":"","img":"images/header_top_add.png","path":"http://www.meituan.com/tuijian/maoyan/131"},
        {"type":0,"ID":"","img":"images/header_top_add.png","path":"http://www.meituan.com/tuijian/maoyan/131"}]}}';
        $return_content =  json_decode($return_content);
        if($return_content->success===true){
            if(property_exists($return_content->content,'recordList')){
                return $return_content->content->recordList;
            }
            return $return_content->content;
        }else{
            return null;
        }
    }

}