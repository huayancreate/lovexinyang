<?php
namespace bootui;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Nav Collapse bootstap widget class file.
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class NavCollapse extends Nav
{
	public $jsOptions = '';
	
	public $type;
	
	public $collapseOptions = ['class' => 'nav-collapse-menu nav'];
	
	public $childBackground = "transparent";

	public function registerCollapsePlugin()
	{
		$this->getView()->registerCss("
		.nav-collapse > .nav-collapse-menu {
			display: none;
		}
		.nav-collapse.open > .nav-collapse-menu {
			display: block;
			background: {$this->childBackground};
		}
		.nav-collapse-container.nav,
		.nav-collapse .nav {
			padding-left: 0px;
			padding-right: 0px;
		}
		");
		$this->getView()->registerJs("$('.nav-collapse-toggle').on('click', function(){ $(this).parent().toggleClass('open'); return false; });");
		$this->getView()->registerJs($this->jsOptions);
	}
	
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'nav-collapse-container');
	}
	
	public function run()
	{
		$this->registerCollapsePlugin();
		parent::run();
	}
	
	/**
	 * Renders a widget's item.
	 * @param string|array $item the item to render.
	 * @return string the rendering result.
	 * @throws InvalidConfigException
	 */
	public function renderItem($item)
	{
		if (is_string($item)) {
			return $item;
		}
		if (!isset($item['label'])) {
			throw new InvalidConfigException("The 'label' option is required.");
		}
		$label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
		$options = ArrayHelper::getValue($item, 'options', []);
		$items = ArrayHelper::getValue($item, 'items');
		$url = Url::to(ArrayHelper::getValue($item, 'url', '#'));
		$linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
	
		if (isset($item['active'])) {
			$active = $item['active'];
			Html::addCssClass($options, 'active');
		} else {
			$active = $this->isItemActive($item);
		}
	
		if ($active) {
			if (ArrayHelper::keyExists('items', $item))
				Html::addCssClass($options, 'open');
			else
				Html::addCssClass($options, 'active');
		}

		Html::addCssClass($options, 'nav-collapse-menu');
		if ($items !== null) {
			Html::addCssClass($options, 'nav-collapse');
			Html::addCssClass($linkOptions, 'nav-collapse-toggle');
			$label .= ' ' . Html::tag('span', Html::tag('b', '', ['class' => 'caret']), ['class'=>'pull-right']);
			if (is_array($items)) {
				$items = $this->renderCollapseItems($items);
			}
		}
	
		return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
	}
	
	/**
	 * Renders menu items.
	 * @param array $items the menu items to be rendered
	 * @return string the rendering result.
	 * @throws InvalidConfigException if the label option is not specified in one of the items.
	 */
	protected function renderCollapseItems($items)
	{
		$lines = [];
		foreach ($items as $i => $item) {
			if (isset($item['visible']) && !$item['visible']) {
				unset($items[$i]);
				continue;
			}
			if (is_string($item)) {
				$lines[] = $item;
				continue;
			}
			if (is_array($item) and ArrayHelper::keyExists('items', $item)) {
				$lines[] = $this->renderItem($item);
				continue;
			}
			if (!isset($item['label'])) {
				throw new InvalidConfigException("The 'label' option is required.");
			}
			$label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
			if (isset($item['badge']))
				$label .= Html::tag('span', $item['badge'], ['class'=>'badge pull-right']);
			$options = ArrayHelper::getValue($item, 'options', []);
			$linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
			$linkOptions['tabindex'] = '-1';
			$content = Html::a($label, ArrayHelper::getValue($item, 'url', '#'), $linkOptions);
			$lines[] = Html::tag('li', $content, $options);
		}
	
		return Html::tag('ul', implode("\n", $lines), $this->collapseOptions);
	}
	
	protected function isItemActive($item)
	{
		if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
			$route = $item['url'][0];
			if ($route[0] !== '/' && \Yii::$app->controller) {
				//$route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
				$route = $this->normalizeRoute($route);
			}
			
			if (ltrim($route, '/') !== $this->route) {
				return false;
			}
			unset($item['url']['#']);
			
			if (count($item['url']) > 1) {
				foreach (array_splice($item['url'], 1) as $name => $value) {
					if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}
}