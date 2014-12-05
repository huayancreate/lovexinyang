<?php

namespace common\hycontrol\hymap;

use yii\web\AssetBundle;

class MapAsset extends AssetBundle
{
    public $sourcePath = '@common/hycontrol/hymap/assest';
    public $js = [
        'js/map.js',
        'js/mapApi.js',
    ];
    public $css = [
        'css/map.css',
    ];

}
