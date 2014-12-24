<?php
namespace bootui;

use yii\helpers\Html;

/**
 * NavBar renderer a bootstrap navigation bar.
 * Navbars are responsive meta components that serve as navigation headers for your application or site. 
 * They begin collapsed (and are toggleable) in mobile views and become horizontal as the available viewport width increases.
 * 
 * Config Options :
 * - `brandLabel` is a string the text of the brand.
 * - `hiddenBrand` set this with array to hidden the brand label where the device width same with class in hidden brand. 
 * valid value are `sm` (hidden on small width), `xs` (hidden on extra small width), `md` (hidden on medium width), and `lg` (hidden on large width).
 * - `brandUrl` is array or string the URL for the brand's hyperlink tag. Defaults to site root.
 * - `brandOptions` is a HTML attributes of the brand link.
 * - `padded` is bool whether the navbar content should be included in a `container` div which adds left and right padding. 
 * Set this to false for a 100% width navbar.
 * - `paddedFluid` is bool whether the navbar content should be included in a `fluid-container` div which adds left and right padding.
 * - `type` string bootstrap navbar type. see type options.
 * - `fixed` set navigation bar to fixed in top or bottom. set false to static navigation bar
 * - `items` is array list menu item.
 * 
 * Type bootstrap Options: 
 * - `default` or `bootui\NavBar::TYPE_DEFAULT` is a white gray background color.
 * - `primary` or `bootui\NavBar::TYPE_PRIMARY` is a blue background color.
 * - `success` or `bootui\NavBar::TYPE_SUCCESS` is a green background color.
 * - `info` or `bootui\NavBar::TYPE_INFO` is a medium blue background color.
 * - `warning` or `bootui\NavBar::TYPE_WARNING` is a yellow background color
 * - `danger` or `bootui\NavBar::TYPE_DANGER` is a red background color.
 * - `inverse` or `bootui\NavBar::TYPE_INVERSE` is a black background color.
 * 
 * Example :
 * ```php
 * <?php
 * // normal mode
 * bootui\NavBar::begin([
 * 	'brandLabel' => 'My Company',
 * 	'brandUrl' => Yii::$app->homeUrl,
 * 	'type' => bootui\NavBar::TYPE_INFO
 * ]);
 * echo bootui\Nav::widget([
 * 	'items' => [
 * 		['label' => 'Home', 'url' => '#'],
 * 		['label' => 'About', 'url' => '#'],
 * 		['label' => 'Contact', 'url' => '#'],
 * 		['label' => 'Profile', 'url' => '#'],
 * 		['label' => 'Content', 'items' => [
 * 			['label' => 'News', 'url' => '#'],
 * 			['label' => 'Pages', 'url' => '#'],
 * 			['label' => 'Files', 'url' => '#'],
 * 		]],
 * 	],
 * 	'isNavbar' => true,
 * ]);
 * bootui\NavBar::end();
 * 
 * // in widget mode
 * echo bootui\NavBar::widget([
 *     'brandLabel' => 'My Company',
 *     'brandUrl' => Yii::$app->homeUrl,
 *     'type' => bootui\NavBar::TYPE_INFO,
 *     'items' => [
 *     [
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
 * ]]);
 * ```
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class NavBar extends Widget
{
	const TYPE_DEFAULT = 'default';
	const TYPE_PRIMARY = 'primary';
	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_DANGER = 'danger';
	const TYPE_INVERSE = 'inverse';
	
	/**
	 * @var string the text of the brand. Note that this is not HTML-encoded.
	 */
	public $brandLabel;
	/**
	 * @var array to hidden the brand label where the device width same with class in hidden brand. 
	 * valid value are `sm` (hidden on small width), `xs` (hidden on extra small width), `md` (hidden on medium width), and `lg` (hidden on large width).
	 */
	public $hiddenBrand = [];	
	/**
	 * @param array|string $url the URL for the brand's hyperlink tag. Defaults to site root.
	 */
	public $brandUrl = '/';
	/**
	 * @var array the HTML attributes of the brand link.
	 */
	public $brandOptions = [];
	/**
	 * @var string text to show for screen readers for the button to toggle the navbar.
	 */
	public $screenReaderToggleText = 'Toggle navigation';
	/**
	 * @var bool whether the navbar content should be included in a `container` div which adds left and right padding.
	 * Set this to false for a 100% width navbar.
	 */
	public $padded = true;
	/**
	 * @var bool whether the navbar content should be included in a `fluid-container` div which adds left and right padding.
	 */
	public $paddedFluid = false;
	/**
	 * @var string bootstrap navbar type. valid value are `default`,`primary`,`success`,`info`,`warning`,`danger`,`inverse`.
	 */
	public $type;
	/**
	 * @var string set navigation bar to fixed in top or bottom. set false to static navigation bar.
	 */
	public $fixed = 'top';
	/**
	 * @var array list menu item.
	 */
	public $items = [];

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
		
		$this->initPadded();
		
		$this->jsOptions = false;
		Html::addCssClass($this->options, 'navbar');
		if ($this->options['class'] == 'navbar') {
			Html::addCssClass($this->options, 'navbar-default');
		}
		Html::addCssClass($this->brandOptions, 'navbar-brand');
		if (empty($this->options['role'])) {
			$this->options['role'] = 'navigation';
		}
		
		$this->initNavbar();
		$this->hiddenBrand();

		echo $this->beginNav();
	}
	
	protected function prepareItems()
	{
		$tag = [];
		
		foreach ($this->items as $item) {
			if (is_string($item)) {
				$tag[] = $item;
			} 
			elseif (is_array($item)) {
				$tag[] = Nav::widget(['items' => $item, 'activeParent' => true, 'isNavbar' => true]);
			}
		}
		
		return implode('', $tag);
	}
	
	protected function initPadded()
	{
		if ($this->paddedFluid)
			$this->padded = false;
	}
	
	protected function beginNav()
	{
		$tag = [];
		
		$tag[] = Html::beginTag('nav', $this->options);
		if ($this->padded) {
			$tag[] = Html::beginTag('div', ['class' => 'container']);
		} elseif ($this->paddedFluid) {
			$tag[] = Html::beginTag('div', ['class' => 'container-fluid']);
		}
		
		$tag[] = Html::beginTag('div', ['class' => 'navbar-header']);
		$tag[] = $this->renderToggleButton();
		if ($this->brandLabel !== null) {
			$tag[] = Html::a($this->brandLabel, $this->brandUrl, $this->brandOptions);
		}
		$tag[] = Html::endTag('div');
		
		$tag[] = Html::beginTag('div', ['class' => "collapse navbar-collapse navbar-{$this->options['id']}-collapse"]);
		
		return implode('', $tag);
	}
	
	protected function endNav()
	{
		$tag = [];
		
		$tag[] = Html::endTag('div');
		if ($this->padded) {
			$tag[] = Html::endTag('div');
		} elseif ($this->paddedFluid) {
			$tag[] = Html::endTag('div');
		}
		$tag[] = Html::endTag('nav');
		
		return implode('', $tag);
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo $this->prepareItems();
		echo $this->endNav();
	}

	/**
	 * Renders collapsible toggle button.
	 * @return string the rendering toggle button.
	 */
	protected function renderToggleButton()
	{
		$bar = Html::tag('span', '', ['class' => 'icon-bar']);
		$screenReader = '<span class="sr-only">'.$this->screenReaderToggleText.'</span>';
		return Html::button("{$screenReader}\n{$bar}\n{$bar}\n{$bar}", [
		'class' => 'navbar-toggle',
		'data-toggle' => 'collapse',
		'data-target' => ".navbar-{$this->options['id']}-collapse",
		]);
	}
	
	protected function hiddenBrand()
	{
		if (!empty($this->hiddenBrand)) {
			foreach ($this->hiddenBrand as $style) {
				Html::addCssClass($this->brandOptions, 'hidden-'.$style);
			} 
		}
	}
	
	protected function initNavbar()
	{
		if (isset($this->fixed) && $this->fixed != false && in_array($this->fixed, ['top', 'bottom'])) {
			Html::addCssClass($this->options, 'navbar-fixed-'.$this->fixed);
		}
		
		if (isset($this->type) && in_array($this->type, ['inverse', 'default', 'primary', 'success', 'info', 'warning', 'danger'])) {
			if (in_array($this->type, ['primary', 'success', 'info', 'warning', 'danger'])) {
				$type = $this->type.'NavbarType';
				$this->$type();
			}
			Html::addCssClass($this->options, 'navbar-'.$this->type);
		}
	}
	
	/**
	 * Registering a css for navbar primary type.
	 */
	protected function primaryNavbarType()
	{
		$this->getView()->registerCss("
		.navbar-primary {
		  background-color: #428bca;
		  border-color: #357ebd;
		}
		
		.navbar-primary .navbar-brand {
		  color: #f5f5f5;
		}
		
		.navbar-primary .navbar-brand:hover,
		.navbar-primary .navbar-brand:focus {
		  color: #ffffff;
		  background-color: transparent;
		}
		
		.navbar-primary .navbar-text {
		  color: #f5f5f5;
		}
		
		.navbar-primary .navbar-nav > li > a {
		  color: #f5f5f5;
		}
		
		.navbar-primary .navbar-nav > li > a:hover,
		.navbar-primary .navbar-nav > li > a:focus {
		  color: #ffffff;
		  background-color: #3276b1;
		}
		
		.navbar-primary .navbar-nav > .active > a,
		.navbar-primary .navbar-nav > .active > a:hover,
		.navbar-primary .navbar-nav > .active > a:focus {
		  color: #ffffff;
		  background-color: #3276b1;
		}
		
		.navbar-primary .navbar-nav > .disabled > a,
		.navbar-primary .navbar-nav > .disabled > a:hover,
		.navbar-primary .navbar-nav > .disabled > a:focus {
		  color: #444444;
		  background-color: transparent;
		}
		
		.navbar-primary .navbar-toggle {
		  border-color: #3276b1;
		}
		
		.navbar-primary .navbar-toggle:hover,
		.navbar-primary .navbar-toggle:focus {
		  background-color: #3276b1;
		}
		
		.navbar-primary .navbar-toggle .icon-bar {
		  background-color: #ffffff;
		}
		
		.navbar-primary .navbar-collapse,
		.navbar-primary .navbar-form {
		  border-color: #3276b1;
		}
		
		.navbar-primary .navbar-nav > .open > a,
		.navbar-primary .navbar-nav > .open > a:hover,
		.navbar-primary .navbar-nav > .open > a:focus {
		  color: #ffffff;
		  background-color: #3276b1;
		}
		
		.navbar-primary .navbar-nav > .dropdown > a:hover .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		.navbar-primary .navbar-nav > .dropdown > a .caret {
		  border-top-color: #eeeeee;
		  border-bottom-color: #eeeeee;
		}
		
		.navbar-primary .navbar-nav > .open > a .caret,
		.navbar-primary .navbar-nav > .open > a:hover .caret,
		.navbar-primary .navbar-nav > .open > a:focus .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		@media (max-width: 767px) {
		  .navbar-primary .navbar-nav .open .dropdown-menu > .dropdown-header {
		    border-color: #3276b1;
		  }
		  .navbar-primary .navbar-nav .open .dropdown-menu > li > a {
		    color: #eeeeee;
		  }
		  .navbar-primary .navbar-nav .open .dropdown-menu > li > a:hover,
		  .navbar-primary .navbar-nav .open .dropdown-menu > li > a:focus {
		    color: #ffffff;
		    background-color: transparent;
		  }
		  .navbar-primary .navbar-nav .open .dropdown-menu > .active > a,
		  .navbar-primary .navbar-nav .open .dropdown-menu > .active > a:hover,
		  .navbar-primary .navbar-nav .open .dropdown-menu > .active > a:focus {
		    color: #ffffff;
		    background-color: #3276b1;
		  }
		  .navbar-primary .navbar-nav .open .dropdown-menu > .disabled > a,
		  .navbar-primary .navbar-nav .open .dropdown-menu > .disabled > a:hover,
		  .navbar-primary .navbar-nav .open .dropdown-menu > .disabled > a:focus {
		    color: #444444;
		    background-color: transparent;
		  }
		}
		
		.navbar-primary .navbar-link {
		  color: #f5f5f5;
		}
		
		.navbar-primary .navbar-link:hover {
		  color: #ffffff;
		}");
	}
	
	/**
	 * Registering css for navbar success type.
	 */
	protected function successNavbarType()
	{
		$this->getView()->registerCss("
		.navbar-success {
		  background-color: #5cb85c;
		  border-color: #4cae4c;
		}
		
		.navbar-success .navbar-brand {
		  color: #f5f5f5;
		}
		
		.navbar-success .navbar-brand:hover,
		.navbar-success .navbar-brand:focus {
		  color: #ffffff;
		  background-color: transparent;
		}
		
		.navbar-success .navbar-text {
		  color: #f5f5f5;
		}
		
		.navbar-success .navbar-nav > li > a {
		  color: #f5f5f5;
		}
		
		.navbar-success .navbar-nav > li > a:hover,
		.navbar-success .navbar-nav > li > a:focus {
		  color: #ffffff;
		  background-color: #47a447;
		  border-color: #398439;
		}
		
		.navbar-success .navbar-nav > .active > a,
		.navbar-success .navbar-nav > .active > a:hover,
		.navbar-success .navbar-nav > .active > a:focus {
		  color: #ffffff;
		  background-color: #47a447;
		}
		
		.navbar-success .navbar-nav > .disabled > a,
		.navbar-success .navbar-nav > .disabled > a:hover,
		.navbar-success .navbar-nav > .disabled > a:focus {
		  color: #444444;
		  background-color: transparent;
		}
		
		.navbar-success .navbar-toggle {
		  border-color: #398439;
		}
		
		.navbar-success .navbar-toggle:hover,
		.navbar-success .navbar-toggle:focus {
		  background-color: #47a447;
		}
		
		.navbar-success .navbar-toggle .icon-bar {
		  background-color: #ffffff;
		}
		
		.navbar-success .navbar-collapse,
		.navbar-success .navbar-form {
		  border-color: #398439;
		}
		
		.navbar-success .navbar-nav > .open > a,
		.navbar-success .navbar-nav > .open > a:hover,
		.navbar-success .navbar-nav > .open > a:focus {
		  color: #ffffff;
		  background-color: #47a447;
		}
		
		.navbar-success .navbar-nav > .dropdown > a:hover .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		.navbar-success .navbar-nav > .dropdown > a .caret {
		  border-top-color: #eeeeee;
		  border-bottom-color: #eeeeee;
		}
		
		.navbar-success .navbar-nav > .open > a .caret,
		.navbar-success .navbar-nav > .open > a:hover .caret,
		.navbar-success .navbar-nav > .open > a:focus .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		@media (max-width: 767px) {
		  .navbar-success .navbar-nav .open .dropdown-menu > .dropdown-header {
		    border-color: #398439;
		  }
		  .navbar-success .navbar-nav .open .dropdown-menu > li > a {
		    color: #eeeeee;
		  }
		  .navbar-success .navbar-nav .open .dropdown-menu > li > a:hover,
		  .navbar-success .navbar-nav .open .dropdown-menu > li > a:focus {
		    color: #ffffff;
		    background-color: transparent;
		  }
		  .navbar-success .navbar-nav .open .dropdown-menu > .active > a,
		  .navbar-success .navbar-nav .open .dropdown-menu > .active > a:hover,
		  .navbar-success .navbar-nav .open .dropdown-menu > .active > a:focus {
		    color: #ffffff;
		    background-color: #47a447;
		  }
		  .navbar-success .navbar-nav .open .dropdown-menu > .disabled > a,
		  .navbar-success .navbar-nav .open .dropdown-menu > .disabled > a:hover,
		  .navbar-success .navbar-nav .open .dropdown-menu > .disabled > a:focus {
		    color: #444444;
		    background-color: transparent;
		  }
		}
		
		.navbar-success .navbar-link {
		  color: #f5f5f5;
		}
		
		.navbar-success .navbar-link:hover {
		  color: #ffffff;
		}
		");
	}
	
	/**
	 * Registering css for navbar info type.
	 */
	protected function infoNavbarType()
	{
		$this->getView()->registerCss("
		.navbar-info {
		  background-color: #5bc0de;
		  border-color: #46b8da;
		}
		
		.navbar-info .navbar-brand {
		  color: #f5f5f5;
		}
		
		.navbar-info .navbar-brand:hover,
		.navbar-info .navbar-brand:focus {
		  color: #ffffff;
		  background-color: transparent;
		}
		
		.navbar-info .navbar-text {
		  color: #f5f5f5;
		}
		
		.navbar-info .navbar-nav > li > a {
		  color: #f5f5f5;
		}
		
		.navbar-info .navbar-nav > li > a:hover,
		.navbar-info .navbar-nav > li > a:focus {
		  color: #ffffff;
		  background-color: #39b3d7;
		  border-color: #269abc;
		}
		
		.navbar-info .navbar-nav > .active > a,
		.navbar-info .navbar-nav > .active > a:hover,
		.navbar-info .navbar-nav > .active > a:focus {
		  color: #ffffff;
		  background-color: #39b3d7;
		}
		
		.navbar-info .navbar-nav > .disabled > a,
		.navbar-info .navbar-nav > .disabled > a:hover,
		.navbar-info .navbar-nav > .disabled > a:focus {
		  color: #444444;
		  background-color: transparent;
		}
		
		.navbar-info .navbar-toggle {
		  border-color: #269abc;
		}
		
		.navbar-info .navbar-toggle:hover,
		.navbar-info .navbar-toggle:focus {
		  background-color: #39b3d7;
		}
		
		.navbar-info .navbar-toggle .icon-bar {
		  background-color: #ffffff;
		}
		
		.navbar-info .navbar-collapse,
		.navbar-info .navbar-form {
		  border-color: #269abc;
		}
		
		.navbar-info .navbar-nav > .open > a,
		.navbar-info .navbar-nav > .open > a:hover,
		.navbar-info .navbar-nav > .open > a:focus {
		  color: #ffffff;
		  background-color: #39b3d7;
		}
		
		.navbar-info .navbar-nav > .dropdown > a:hover .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		.navbar-info .navbar-nav > .dropdown > a .caret {
		  border-top-color: #eeeeee;
		  border-bottom-color: #eeeeee;
		}
		
		.navbar-info .navbar-nav > .open > a .caret,
		.navbar-info .navbar-nav > .open > a:hover .caret,
		.navbar-info .navbar-nav > .open > a:focus .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		@media (max-width: 767px) {
		  .navbar-info .navbar-nav .open .dropdown-menu > .dropdown-header {
		    border-color: #269abc;
		  }
		  .navbar-info .navbar-nav .open .dropdown-menu > li > a {
		    color: #eeeeee;
		  }
		  .navbar-info .navbar-nav .open .dropdown-menu > li > a:hover,
		  .navbar-info .navbar-nav .open .dropdown-menu > li > a:focus {
		    color: #ffffff;
		    background-color: transparent;
		  }
		  .navbar-info .navbar-nav .open .dropdown-menu > .active > a,
		  .navbar-info .navbar-nav .open .dropdown-menu > .active > a:hover,
		  .navbar-info .navbar-nav .open .dropdown-menu > .active > a:focus {
		    color: #ffffff;
		    background-color: #39b3d7;
		  }
		  .navbar-info .navbar-nav .open .dropdown-menu > .disabled > a,
		  .navbar-info .navbar-nav .open .dropdown-menu > .disabled > a:hover,
		  .navbar-info .navbar-nav .open .dropdown-menu > .disabled > a:focus {
		    color: #444444;
		    background-color: transparent;
		  }
		}
		
		.navbar-info .navbar-link {
		  color: #f5f5f5;
		}
		
		.navbar-info .navbar-link:hover {
		  color: #ffffff;
		}
		");
	}
	
	/**
	 * Registering css for navbar warning type.
	 */
	protected function warningNavbarType()
	{
		$this->getView()->registerCss("
		.navbar-warning {
		  background-color: #f0ad4e;
		  border-color: #eea236;
		}
		
		.navbar-warning .navbar-brand {
		  color: #f5f5f5;
		}
		
		.navbar-warning .navbar-brand:hover,
		.navbar-warning .navbar-brand:focus {
		  color: #ffffff;
		  background-color: transparent;
		}
		
		.navbar-warning .navbar-text {
		  color: #f5f5f5;
		}
		
		.navbar-warning .navbar-nav > li > a {
		  color: #f5f5f5;
		}
		
		.navbar-warning .navbar-nav > li > a:hover,
		.navbar-warning .navbar-nav > li > a:focus {
		  color: #ffffff;
		  background-color: #ed9c28;
		  border-color: #d58512;
		}
		
		.navbar-warning .navbar-nav > .active > a,
		.navbar-warning .navbar-nav > .active > a:hover,
		.navbar-warning .navbar-nav > .active > a:focus {
		  color: #ffffff;
		  background-color: #ed9c28;
		}
		
		.navbar-warning .navbar-nav > .disabled > a,
		.navbar-warning .navbar-nav > .disabled > a:hover,
		.navbar-warning .navbar-nav > .disabled > a:focus {
		  color: #444444;
		  background-color: transparent;
		}
		
		.navbar-warning .navbar-toggle {
		  border-color: #d58512;
		}
		
		.navbar-warning .navbar-toggle:hover,
		.navbar-warning .navbar-toggle:focus {
		  background-color: #ed9c28;
		}
		
		.navbar-warning .navbar-toggle .icon-bar {
		  background-color: #ffffff;
		}
		
		.navbar-warning .navbar-collapse,
		.navbar-warning .navbar-form {
		  border-color: #d58512;
		}
		
		.navbar-warning .navbar-nav > .open > a,
		.navbar-warning .navbar-nav > .open > a:hover,
		.navbar-warning .navbar-nav > .open > a:focus {
		  color: #ffffff;
		  background-color: #ed9c28;
		}
		
		.navbar-warning .navbar-nav > .dropdown > a:hover .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		.navbar-warning .navbar-nav > .dropdown > a .caret {
		  border-top-color: #eeeeee;
		  border-bottom-color: #eeeeee;
		}
		
		.navbar-warning .navbar-nav > .open > a .caret,
		.navbar-warning .navbar-nav > .open > a:hover .caret,
		.navbar-warning .navbar-nav > .open > a:focus .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		@media (max-width: 767px) {
		  .navbar-warning .navbar-nav .open .dropdown-menu > .dropdown-header {
		    border-color: #d58512;
		  }
		  .navbar-warning .navbar-nav .open .dropdown-menu > li > a {
		    color: #eeeeee;
		  }
		  .navbar-warning .navbar-nav .open .dropdown-menu > li > a:hover,
		  .navbar-warning .navbar-nav .open .dropdown-menu > li > a:focus {
		    color: #ffffff;
		    background-color: transparent;
		  }
		  .navbar-warning .navbar-nav .open .dropdown-menu > .active > a,
		  .navbar-warning .navbar-nav .open .dropdown-menu > .active > a:hover,
		  .navbar-warning .navbar-nav .open .dropdown-menu > .active > a:focus {
		    color: #ffffff;
		    background-color: #ed9c28;
		  }
		  .navbar-warning .navbar-nav .open .dropdown-menu > .disabled > a,
		  .navbar-warning .navbar-nav .open .dropdown-menu > .disabled > a:hover,
		  .navbar-warning .navbar-nav .open .dropdown-menu > .disabled > a:focus {
		    color: #444444;
		    background-color: transparent;
		  }
		}
		
		.navbar-warning .navbar-link {
		  color: #f5f5f5;
		}
		
		.navbar-warning .navbar-link:hover {
		  color: #ffffff;
		}
		");
	}
	
	/**
	 * Registering css for navbar danger type.
	 */
	protected function dangerNavbarType()
	{
		$this->getView()->registerCss("
		.navbar-danger {
		  background-color: #d9534f;
		  border-color: #d43f3a;
		}
		
		.navbar-danger .navbar-brand {
		  color: #f5f5f5;
		}
		
		.navbar-danger .navbar-brand:hover,
		.navbar-danger .navbar-brand:focus {
		  color: #ffffff;
		  background-color: transparent;
		}
		
		.navbar-danger .navbar-text {
		  color: #f5f5f5;
		}
		
		.navbar-danger .navbar-nav > li > a {
		  color: #f5f5f5;
		}
		
		.navbar-danger .navbar-nav > li > a:hover,
		.navbar-danger .navbar-nav > li > a:focus {
		  color: #ffffff;
		  background-color: #d2322d;
		  border-color: #ac2925;
		}
		
		.navbar-danger .navbar-nav > .active > a,
		.navbar-danger .navbar-nav > .active > a:hover,
		.navbar-danger .navbar-nav > .active > a:focus {
		  color: #ffffff;
		  background-color: #d2322d;
		}
		
		.navbar-danger .navbar-nav > .disabled > a,
		.navbar-danger .navbar-nav > .disabled > a:hover,
		.navbar-danger .navbar-nav > .disabled > a:focus {
		  color: #444444;
		  background-color: transparent;
		}
		
		.navbar-danger .navbar-toggle {
		  border-color: #ac2925;
		}
		
		.navbar-danger .navbar-toggle:hover,
		.navbar-danger .navbar-toggle:focus {
		  background-color: #d2322d;
		}
		
		.navbar-danger .navbar-toggle .icon-bar {
		  background-color: #ffffff;
		}
		
		.navbar-danger .navbar-collapse,
		.navbar-danger .navbar-form {
		  border-color: #ac2925;
		}
		
		.navbar-danger .navbar-nav > .open > a,
		.navbar-danger .navbar-nav > .open > a:hover,
		.navbar-danger .navbar-nav > .open > a:focus {
		  color: #ffffff;
		  background-color: #d2322d;
		}
		
		.navbar-danger .navbar-nav > .dropdown > a:hover .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		.navbar-danger .navbar-nav > .dropdown > a .caret {
		  border-top-color: #eeeeee;
		  border-bottom-color: #eeeeee;
		}
		
		.navbar-danger .navbar-nav > .open > a .caret,
		.navbar-danger .navbar-nav > .open > a:hover .caret,
		.navbar-danger .navbar-nav > .open > a:focus .caret {
		  border-top-color: #ffffff;
		  border-bottom-color: #ffffff;
		}
		
		@media (max-width: 767px) {
		  .navbar-danger .navbar-nav .open .dropdown-menu > .dropdown-header {
		    border-color: #ac2925;
		  }
		  .navbar-danger .navbar-nav .open .dropdown-menu > li > a {
		    color: #eeeeee;
		  }
		  .navbar-danger .navbar-nav .open .dropdown-menu > li > a:hover,
		  .navbar-danger .navbar-nav .open .dropdown-menu > li > a:focus {
		    color: #ffffff;
		    background-color: transparent;
		  }
		  .navbar-danger .navbar-nav .open .dropdown-menu > .active > a,
		  .navbar-danger .navbar-nav .open .dropdown-menu > .active > a:hover,
		  .navbar-danger .navbar-nav .open .dropdown-menu > .active > a:focus {
		    color: #ffffff;
		    background-color: #d2322d;
		  }
		  .navbar-danger .navbar-nav .open .dropdown-menu > .disabled > a,
		  .navbar-danger .navbar-nav .open .dropdown-menu > .disabled > a:hover,
		  .navbar-danger .navbar-nav .open .dropdown-menu > .disabled > a:focus {
		    color: #444444;
		    background-color: transparent;
		  }
		}
		
		.navbar-danger .navbar-link {
		  color: #f5f5f5;
		}
		
		.navbar-danger .navbar-link:hover {
		  color: #ffffff;
		}
		");
	}
}