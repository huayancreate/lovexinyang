<?php

namespace  common\hycontrol\hymap;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class MapWidget extends Widget
{
    const PLUGIN_NAME = 'Map';

    /**
     * Map Options
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var boolean
     */
    public $render = true;

    public function run()
    {
        $this->registerClientScript();
    }

    public function registerClientScript()
    {
        $view = $this->getView();
        $asset = MapAsset::register($view);
        $view->registerCssFile($asset->baseUrl . "/css/map.css", ['depends' => 'common\hycontrol\hymap\MapAsset']);
        
        $view->registerJsFile($asset->baseUrl . '/js/mapApi.js', ['depends' => 'common\hycontrol\hymap\MapAsset']);
        $id = $this->getModel('MapViewId');
        $varName = self::PLUGIN_NAME . '_' . str_replace('-', '_', $id);
        $js = "
Map.ready(function(K) {
    {$preJs};
    var {$varName} = K.init('#{$id}'," . Json::encode($this->clientOptions) . ");});
";
        $view->registerJs($js);
    }
  
}
