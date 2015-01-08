<?php

namespace backend\assets;

use yii\web\AssetBundle;
/**
 * Description of TreeAsset
 *
 * @author Administrator
 */
class TreeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/treeview.css',
    ];
    public $depends = [
        'backend\assets\BootstrapjsAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
} 