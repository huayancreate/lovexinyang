<?php
namespace common\hycommon\tool;

use Yii;
/**
 * Created by PhpStorm.
 * User: pan
 * Date: 2014/12/14
 * Time: 22:15
 */

class GenerateValidateCode {

 public   $name = '__validateCode';

    /**
     * 获取数字验证码.
     * @param boolean $regenerate whether the verification code should be regenerated.
     * @return string the verification code.
     */
    public function getNumberCode($regenerate = false,$length)
    {
        $session = Yii::$app->getSession();
        $session->open();
        if ($session[$this->name] === null || $regenerate) {
            $session[$this->name] = $this->generateNumberCode($length);
            //$session->setTimeout(300);
        }
        return $session[$this->name];
    }

    /**
     * 生成数字验证码
     * @return string the generated verification code
     */
    protected function generateNumberCode($length)
    {
        $num = '1234567890';
        $code = '';
        for ($i = 0; $i < $length; ++$i) {
            //if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
                $code .= $num[mt_rand(0, 9)];
            //}
        }

        return $code;
    }

    /**
     * Validates the input to see if it matches the generated code.
     * @param string $input user input
     * @param boolean $caseSensitive whether the comparison should be case-sensitive
     * @return boolean whether the input is valid
     */
    public function validate($input)
    {
        $code = $this->getNumberCode(false,6);
        if($code==null){
            return false;
        }
        $valid = $input === $code  ;
        $session = Yii::$app->getSession();
        $session->open();
        if ($valid ) {
            $session->remove($this->name);
            $session->remove($this->name . '_count');
        }
        return $valid;
    }

}