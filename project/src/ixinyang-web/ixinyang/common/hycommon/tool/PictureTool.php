<?php
namespace common\hycommon\tool;

use Yii;
/**
 * User: mawang
 * Date: 2015/1/9
 * Time: 16:50
 */

class PictureTool {

   /**
    * [uploads 上传图片]
    * @param  [type] $file [文件集合]
    * @param  [type] $type [图片分类  1 广告  2 商品]
    * @return [type]       [description]
    */
    public function uploads($file,$type){

        if (count($file)>0) {
            //广告图片路径  
            if ($type==1) {
                $filePath = "uploads/adPic/";
                $ext=$file->extension;
            }else if ($type==2) {
                $filePath = "uploads/goodsPic/";
                $ext = $file->getExtension($file); //获取文件后缀 如: ".jpg"
            }
            
            $randName = time() . rand(1000, 9999) . "." . $ext; //生成新文件名称

            if(!file_exists($filePath)){
                mkdir($filePath,0777,true);
            }

            $file->saveAs($filePath.$randName); //保存文件

            return $filePath.$randName;
        }
        
    }
    
    /**
     * [delfile 删除某个图片]
     * @param  [type] $fullpath [图片路径]
     * @return [type]           [description]
     */
    public function delfile($fullpath) {
          if(!is_dir($fullpath)) {
              unlink($fullpath);//删除目录中的所有文件
          } else {
              delfile($fullpath);
          }
    }


}