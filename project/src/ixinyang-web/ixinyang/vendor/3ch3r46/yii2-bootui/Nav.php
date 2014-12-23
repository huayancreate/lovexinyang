<?php
namespace bootui;

use yii\base\InvalidParamException;

use Yii;

use yii\helpers\Html;

use yii\helpers\ArrayHelper;

use yii\helpers\Url;

use yii\base\InvalidConfigException;

/**
 * Nav renderer a bootstrap navigation.
 * 
 * Config Options:
 * - `items` is an array lst of items in the nav widget. see Items Config Options.
 * - `activeParent` set true if parent of the children item is active and parent will active.
 * - `isNavbar` set true where this nav is use in navbar. see bootui\NavBar example.
 * - `type` set this to set the navigation type. valid value are `pills` or `bootui\Nav::TYPE_PILLS` and `tabs` or `bootui\Nav::TYPE_TABS`.
 * - `justified` set true to easily make tabs or pills equal widths of their parent at screens wider than 768px. 
 * On smaller screens, the nav links are stacked.
 * - `stacked` set true whether `pills` or `tabs` are also vertically stackable.
 * - `collapse` set true whether navigation are also collapse the dropdown menu.
 * 
 * Items Config Options:
 * - `label` string the nav item label.
 * - `url` set the absolute url or with array the item's URL. Defaults to "#".
 * - `visible` set true than this menu item is visible. Defaults to true.
 * - `linkOptions` is array HTML attributes of the item's link.
 * - `options` array the HTML attributes of the item container (LI).
 * - `active` set true than the item on active state or false to not active state.
 * - `items` array or string render a bootstrap dropdown menu.
 * 
 * Example : 
 * ```php
 * <?php
 * echo bootui\Nav::widget([
 *     'items' => [
 *         ['label' => 'Home', 'url' => '#'],
 *         ['label' => 'About', 'url' => '#'],
 *         ['label' => 'Contact', 'url' => '#'],
 *         ['label' => 'Profile', 'url' => '#'],
 *         ['label' => 'Content', 'items' => [
 *             ['label' => 'News', 'url' => '#'],
 *             ['label' => 'Pages', 'url' => '#'],
 *             ['label' => 'Files', 'url' => '#'],
 *         ]],
 *     ],
 *     'type' => bootui\Nav::TYPE_PILLS
 * ]);
 * ```
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class Nav extends Widget
{
	const TYPE_PILLS = 'pills';
	const TYPE_TABS = 'tabs';
	
	public $items = [];
	
	public $encodeLabels = false;
	
	public $activeItem = true;

	public $activeParent = false;
	
	public $type;
	
	public $route;
	
	public $params;
	
	public $isNavbar;
	
	public $justified;
	
	public $stacked;
	
	public $collapse;
	
	public function init()
	{
		parent::init();
		if ($this->route === null && Yii::$app->controller !== null) {
			$this->route = Yii::$app->controller->getRoute();
		}
		if ($this->params === null) {
			$this->params = Yii::$app->request->getQueryParams();
		}
		Html::addCssClass($this->options, 'nav');
		if (isset($this->isNavbar) && $this->isNavbar) {
			Html::addCssClass($this->options, 'navbar-nav');
		}
		if (isset($this->collapse) and $this->collapse) {
			$this->initCollapse();
			if (in_array($this->type, [static::TYPE_PILLS,static::TYPE_TABS])) {
				$this->stacked = true;
			}
		}
		if (isset($this->type) and in_array($this->type, [static::TYPE_PILLS,static::TYPE_TABS])) {
			Html::addCssClass($this->options, 'nav-' . $this->type);
		}
		if (isset($this->justified) and $this->justified) {
			Html::addCssClass($this->options, 'nav-justified');
		}
		if (isset($this->stacked) and $this->stacked) {
			Html::addCssClass($this->options, 'nav-stacked');
		}
	}
	
	public function run()
	{
		echo $this->renderItems();
	}
	
	public function renderItems()
	{
		$items = [];
		foreach ($this->items as $i => $item) {
			$item = static::prepareConfig($item);
			if (isset($item['visible']) && !$item['visible']) {
				unset($items[$i]);
				continue;
			}
			$items[] = $this->renderItem($item);
		}
	
		return Html::tag('ul', implode("\n", $items), $this->options);
	}
	
	/**
	 * Renderer a navigation item.
	 * @param array $item
	 * @throws InvalidConfigException
	 * @return string
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
	
		if (isset($item['disable']) && $item['disable']) {
			Html::addCssClass($options, 'disabled');
		}
		
		if (isset($item['active'])) {
			$active = ArrayHelper::remove($item, 'active', false);
		} else {
			$active = $this->isItemActive($item);
		}
	
		if ($active) {
			Html::addCssClass($options, 'active');
		}
	
		if ($items !== null) {
			$linkOptions['data-toggle'] = 'dropdown';
			Html::addCssClass($options, 'dropdown');
			Html::addCssClass($linkOptions, 'dropdown-toggle');
			$label .= ' ' . Html::tag('b', '', ['class' => 'caret']);
			if (is_array($items)) {
				if ($this->activeItem) {
					$items = $this->isItemChildActive($items, $active);
				}
				$items = Dropdown::widget([
						'items' => $items,
						'encodeLabels' => $this->encodeLabels,
						'jsOptions' => false,
						'view' => $this->getView(),
						]);
			}
		}
		
		if ($this->activeItem && $active) {
			Html::addCssClass($options, 'active');
		}
	
		return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
	}
	
	/**
	 * Check is item active.
	 * @param array $item
	 */
	protected function isItemActive($item)
	{
		if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
			$route = $item['url'][0];
			if ($route[0] !== '/' && Yii::$app->controller) {
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
	
	protected function isItemChildActive($items, &$active)
	{
		foreach ($items as $i => $child) {
			if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
				Html::addCssClass($items[$i]['options'], 'active');
				if ($this->activeParent) {
					$active = true;
				}
			}
		}
		return $items;
	}
	
	/**
	 * Normalize an url route.
	 * @param mixed $route
	 * @throws InvalidParamException
	 */
	protected function normalizeRoute($route)
	{
		$route = (string) $route;
		if (strncmp($route, '/', 1) === 0) {
			// absolute route
			return ltrim($route, '/');
		}
		
		// relative route
		if (Yii::$app->controller === null) {
			throw new InvalidParamException("Unable to resolve the relative route: $route. No active controller is available.");
		}
		
		if (strpos($route, '/') === false) {
			// empty or an action ID
			return $route === '' ? Yii::$app->controller->getRoute() : Yii::$app->controller->getUniqueId() . '/' . $route;
		} else {
			// relative to module
			return ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
		}
	}
	
	protected function initCollapse()
	{
		Html::addCssClass($this->options, 'collapse-nav');
		$this->getView()->registerCss("
		.collapse-nav .open .dropdown-menu {
		    position: static;
		    float: none;
		    width: auto;
		    margin-top: 0;
			margin-left: 0px;
		    background-color: transparent;
		    border: 1px solid #f0f0f0;
		    -webkit-box-shadow: none;
		            box-shadow: none;
		}
		.collapse-nav .open .dropdown-menu > li > a,
		.collapse-nav .open .dropdown-menu .dropdown-header {
		    padding: 5px 15px 5px 25px;
		}
		.collapse-nav .open .dropdown-menu > li > a {
		    line-height: 20px;
		}
		.collapse-nav .open .dropdown-menu > li > a:hover,
		.collapse-nav .open .dropdown-menu > li > a:focus {
		    background-image: none;
		}	
		");
	}
}