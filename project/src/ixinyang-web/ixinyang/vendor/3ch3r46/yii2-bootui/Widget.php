<?php
namespace bootui;

use Yii;
use yii\helpers\ArrayHelper;
/**
 * Widget renderer class.
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class Widget extends \yii\base\Widget
{
	/**
	 * @var array the HTML attributes for the widget container tag.
	 */
	public $options = [];
	/**
	 * @var array the options for the underlying Bootstrap Javascript plugin.
	 * Please refer to the corresponding Bootstrap plugin Web page for possible options.
	 */
	public $jsOptions = [];
	/**
	 * @var array the event handlers for the underlying Bootstrap Javascript plugin.
	 * Please refer to the corresponding Bootstrap plugin Web page for possible events.
	 */
	public $jsEvents = [];


	/**
	 * Initializes the widget.
	 * This method will register the bootstrap asset bundle. If you override this method,
	 * make sure you call the parent implementation first.
	 */
	public function init()
	{
		$view = $this->getView();
		
		parent::init();
		
		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->getId();
		}
		
		if (YII_DEBUG)
			asset\CoreJs::register($view);
		else
			asset\CoreJsMin::register($view);
	}

	/**
	 * Registers a specific Bootstrap plugin and the related events
	 * @param string $name the name of the Bootstrap plugin
	 */
	protected function registerPlugin($pluginName)
	{
		$view = $this->getView();
		
		$id = $this->options['id'];

		if ($this->jsOptions !== false) {
			$options = empty($this->jsOptions) ? '' : JSON::encode($this->jsOptions);
			$js = "jQuery('#$id').$pluginName($options);";
			$view->registerJs($js);
		}

		if (!empty($this->jsEvents)) {
			$js = [];
			foreach ($this->jsEvents as $event => $handler) {
				$js[] = "jQuery('#$id').on('$event', $handler);";
			}
			$view->registerJs(implode("\n", $js));
		}
		
		$view->registerJs("jQuery('body').tooltip({'selector':'[rel=tooltip]'});\njQuery('body').tooltip({'selector':'[data-toggle=tooltip]'});\njQuery('body').tooltip({'selector':'[data-toggle=popover]'});");
	}
	


	protected static function prepareSConfig($config) {
		if (strpos($config,',')) {
			$configs = explode(',', $config);
			$config = [];
			foreach ($configs as $data) {
				$values = explode('=', $data, 2);
				if (!isset($values[1])) {
					$config[] = $values[0];
				} else {
					$config[$values[0]] = $values[1];
				}
			}
		}
		return $config;
	}
	
	public static function prepareConfig($config) {
		if (is_string($config)) {
			$configs = explode(';', $config);
			$config = [];
			foreach ($configs as $data) {
				$values = explode(':', $data, 2);
				if (!isset($values[1])) {
					$config[] = static::prepareSConfig($values[0]);
				} else {
					$config[$values[0]] = static::prepareSConfig($values[1]);
				}
			}
	
			if (!isset($config['label']) && isset($config[0])) {
				$config['label'] = ArrayHelper::remove($config, 0);
			}
	
			if (!isset($config['url']) && isset($config[1])) {
				$config['url'] = ArrayHelper::remove($config, 1);
			}
		}
		return $config;
	}
}
