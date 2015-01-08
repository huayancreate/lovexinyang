<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/zTreeStyle.css',
        'css/business.css',
    ];
    public $js = [
        'js/jquery.ztree.all-3.5.js',
        'js/jquery.ztree.core-3.5.min.js',
        'js/jquery.ztree.excheck-3.5.min.js',
        'js/jquery.iframeDialog.js',
        'js/map.js',
	    'js/dialog.js',
        'js/bootstrap-Dialog.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
