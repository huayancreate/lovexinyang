<?php
namespace bootui;

use yii\helpers\ArrayHelper;

use \yii\helpers\Html;
/**
 * Button Widget renderer a bootstrap button.
 * Button renderer more `buttonType` : `default`, `button`, `submit`, `buttonInput`, and `submitInput`.
 * And have a more `type` bootstrap button: 
 * `default` or `bootui\Button::TYPE_DEFAULT` is a Standard button.
 * `primary` or `bootui\Button::TYPE_PRIMARY` is a Provides extra visual weight and identifies the primary action in a set of buttons.
 * `success` or `bootui\Button::TYPE_SUCCESS` is an Indicates a successful or positive action.
 * `info` or `bootui\Button::TYPE_INFO` is a Contextual button for informational alert messages.
 * `warning` or `bootui\Button::TYPE_WARNING` is an Indicates caution should be taken with this action.
 * `danger` or `bootui\Button::TYPE_DANGER` is an Indicates a dangerous or potentially negative action.
 * `link` or `bootui\Button::TYPE_LINK` is a Deemphasize a button by making it look like a link while maintaining button behavior.
 * Sizing a button in option `size` have 3 size : `xs`(Extra Small), `sm` (Small), and `lg` (Large). Don't use size option if you use a default size.
 * Block a button with option `block` those that span the full width of a parent.
 * Active State Button with option `active` and valid value are boolean `true` or `false` and buttons will appear pressed (with a darker background, darker border, and inset shadow) when active..
 * Disable State with option `disable` and valid value are boolean `true` or `false` and make buttons look unclickable by fading them back 50%.
 * ## Example in button widget default mode:
 * 
 * ```php
 * 
 * <?php
 * // default format bootui\Button::widget($config).
 * 
 * // for button mode.
 * echo bootui\Button::widget([
 *     'label' => 'Button Action',
 *     'type' => bootui\Button::TYPE_PRIMARY,
 *     'buttonType' => 'button',
 * ]);
 * 
 * // for link mode.
 * echo bootui\Button::widget([
 *     'label' => 'Button Action',
 *     'type' => bootui\Button::TYPE_PRIMARY,
 *     'url' => 'http:://bitbucket.org/3ch3r46',
 * ]);
 * 
 * ```
 * 
 * ## Example with other mode:
 * 
 * ### Link
 * link mode in default with array config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::link([
 *     'label' => 'My Home Page Link',
 *     'url' => 'http:://bitbucket.org/3ch3r46',
 *     'type' => bootui\Button::TYPE_PRIMARY
 * ]);
 * 
 * ```
 * 
 * link mode in string config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::link('label:My Home Page Link;url:bitbucket.org/3ch3r46;type:primary');
 * 
 * ```
 * 
 * or link without key config, only for `label` in first config and `url` for second config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::link('My Home Page Link;bitbucket.org/3ch3r46;type:primary');
 * 
 * ```
 * 
 * ### Button.
 * button with array config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::button([
 *     'label' => 'Action',
 *     'type' => bootui\Button::TYPE_PRIMARY
 * ]);
 * 
 * ```
 * 
 * button in string config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::button('label:Action;type:primary');
 * 
 * ```
 * 
 * ### Submit Button.
 * submit button with array config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::submit([
 *     'label' => 'Action',
 *     'type' => bootui\Button::TYPE_PRIMARY
 * ]);
 * 
 * ```
 * 
 * submit button in string config.
 * ```php
 * 
 * <?php
 * echo bootui\Button::submit('label:Action;type:primary');
 * 
 * ```
 * 
 * # Button Loading
 * see bootui\Button::loading(); or bootui\ButtonLoading::widget()
 * 
 * # Button Dropdown
 * see bootui\Button::dropdown(); or bootui\ButtonDropdown::widget()
 * 
 * # Button Group
 * see bootui\Button::group(); or bootui\ButtonGroup::widget()
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class Button extends Widget
{
	//list group type
	const TYPE_DEFAULT = 'default';
	const TYPE_PRIMARY = 'primary';
	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_DANGER = 'danger';
	const TYPE_LINK = 'link';
	
	//button type
	const B_DEFAULT = 'default';
	const B_BUTTON = 'button';
	const B_BUTTON_INPUT = 'buttonInput';
	const B_SUBMIT = 'submit';
	const B_SUBMIT_INPUT = 'submitInput';
	
	public $tagName = 'button';
	/**
	 * @var string the button label
	 */
	public $label = 'Button';

	public $buttonType = 'default';
	
	public $encodeLabel = false;
	
	public $type = 'default';
	
	public $disable;
	
	public $size;
	
	public $block = false;
	
	public $active = false;
	
	public $toggle;
	
	public $url;
	
	public $tooltip;
	
	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		$this->jsOptions = false;
		Html::addCssClass($this->options, 'btn');
		
		$this->initOptions();
		
		if (isset($this->tooltip))
			$this->initTooltip();
	}
	
	public function run()
	{
		echo $this->renderButton();
		$this->registerPlugin('button');
	}
	
	protected function initTooltip()
	{
		$this->options['rel'] = 'tooltip';
		
		if (is_string($this->tooltip)) {
			$this->options['title'] = $this->tooltip;
		} elseif (is_array($this->tooltip)) {
			if (isset($this->tooltip['title']))
				$this->options['title'] = $this->tooltip['title'];
			if (isset($this->tooltip['placement']))
				$this->options['data-placement'] = $this->tooltip['placement'];
		}
	}
	
	protected function initOptions()
	{
		$typeValidValue = ['default','link','primary','success','info','warning','danger'];
		if(isset($this->type) and in_array($this->type, $typeValidValue))
		{
			Html::addCssClass($this->options, 'btn-' . $this->type);
		}
		
		$sizeValidValue = ['xs','sm','lg'];
		if(isset($this->size) and in_array($this->size, $sizeValidValue))
		{
			Html::addCssClass($this->options, 'btn-' . $this->size);
		}
		
		if ($this->block)
			Html::addCssClass($this->options, 'btn-block');
		
		if ($this->active)
			Html::addCssClass($this->options, 'active');
		
		if (isset($this->toggle))
			$this->options['data-toggle'] = $this->toggle;
		
		if (isset($this->disable) and $this->disable) {
			if ($this->buttonType == "default") {
				Html::addCssClass($this->options, 'disabled');
			} else {
				$this->options['disabled'] = 'disabled';
			}
		}
	}
	
	protected function renderButton()
	{
		$validValue = ['default','button','buttonInput','submit','submitInput'];
		if(in_array($this->buttonType, $validValue))
		{
			if ($this->buttonType == static::B_DEFAULT or isset($this->url)) {
				$this->options['role'] = "button";
				return Html::a($this->encodeLabel ? Html::encode($this->label) : $this->label, $this->url, $this->options);
			}
			if ($this->buttonType == static::B_BUTTON)
				return Html::button($this->encodeLabel ? Html::encode($this->label) : $this->label, $this->options);
			if ($this->buttonType == static::B_BUTTON_INPUT)
				return Html::buttonInput($this->encodeLabel ? Html::encode($this->label) : $this->label, $this->options);
			if ($this->buttonType == static::B_SUBMIT)
				return Html::submitButton($this->encodeLabel ? Html::encode($this->label) : $this->label, $this->options);
			if ($this->buttonType == static::B_SUBMIT_INPUT)
				return Html::submitInput($this->encodeLabel ? Html::encode($this->label) : $this->label, $this->options);
		}
	}
	
	protected static $_config;
		
	/**
	 * Button Link.
	 * link mode in default with array config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::link([
	 *     'label' => 'My Home Page Link',
	 *     'url' => 'http:://bitbucket.org/3ch3r46',
	 *     'type' => bootui\Button::TYPE_DEFAULT
	 * ]);
	 * 
	 * ```
	 * 
	 * link mode in string config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::link('label:My Home Page Link;url:bitbucket.org/3ch3r46;type:primary');
	 * 
	 * ```
	 * 
	 * or link without key config, only for `label` in first config and `url` for second config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::link('My Home Page Link;bitbucket.org/3ch3r46;type:primary');
	 * 
	 * ```
	 * @param array|string $config
	 */
	public static function link($config)
	{
		self::$_config = ['buttonType' => static::B_DEFAULT];
		
		self::$_config = array_merge(self::$_config, static::prepareConfig($config));
		
		return static::widget(self::$_config);
	}
	
	/**
	 * Button.
	 * button with array config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::button([
	 *     'label' => 'Action',
	 *     'type' => bootui\Button::TYPE_INFO
	 * ]);
	 * 
	 * ```
	 * 
	 * button in string config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::button('label:Action;type:primary');
	 * 
	 * ```
	 * @param array|string $config
	 * @return string
	 */
	public static function button($config)
	{
		self::$_config = ['buttonType' => static::B_BUTTON];
		
		self::$_config = array_merge(self::$_config, static::prepareConfig($config));
		
		return static::widget(self::$_config);
	}
	
	/**
	 * Submit Button.
	 * submit button with array config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::submit([
	 *     'label' => 'Action',
	 *     'type' => bootui\Button::TYPE_SUCCESS
	 * ]);
	 * 
	 * ```
	 * 
	 * submit button in string config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::submit('label:Action;type:primary');
	 * 
	 * ```
	 * @param array|string $config
	 * @return string
	 */
	public static function submit($config)
	{
		self::$_config = ['buttonType' => static::B_SUBMIT];
		
		self::$_config = array_merge(self::$_config, static::prepareConfig($config));
		
		return static::widget(self::$_config);
	}
	
	/**
	 * Button Group.
	 * Group a series of buttons together on a single line with the button group.
	 * Button group have more option :
	 * 
	 * `buttons` is each array element represents a single button, which can be specified as a string or an array or button object or button dropdown object of the following structure:
	 * - label: string, required, the button label.
	 * - options: array, optional, the HTML attributes of the button.
	 * `size` is a sizing button have 3 size : `xs`(Extra Small), `sm` (Small), and `lg` (Large). Don't use size option if you use a default size.
	 * `vertical` is make a set of buttons appear vertically stacked rather than horizontally.
	 * `justified` is make a group of buttons stretch at equal sizes to span the entire width of its parent. Also works with button dropdowns within the button group.
	 * `block` is a button those that span the full width of a parent.
	 * 
	 * Example:
	 * ```php
	 * 
	 * <?php 
	 * echo bootui\Button::group([
	 * 		'justified'=>true, 
	 * 		'size' => 'lg',
	 * 		'buttons'=>[
	 * 			bootui\Button::widget(['label'=>'No One']),
	 * 			bootui\Button::widget(['label'=>'No Two']),
	 * 			[
	 * 				'label'=>'No Three', 
	 * 				'items' => [
	 * 					['label' => 'dropone'],
	 * 					['label' => 'droptwo'],
	 * 				]
	 * 			]
	 * 		]
	 * ]);
	 * 
	 * ```
	 * @param array $config
	 * @return string
	 */
	public static function group($config)
	{
		return ButtonGroup::widget($config);
	}
	
	/**
	 * Button Dropdown.
	 * Button Dropdown renderer bootstrap dropdown button.
	 * Config options in button dropdown:
	 * - `type` is a type of button valid value are 'default','primary','success','info','warning','danger'.
	 * - `item` is a list button dropdown.
	 * - `size` is a sizing button valid value are `lg`(Large),`sm`(Small),`xs`(Extra Small).
	 * - `split` is a whether to display a group of split-styled button group.
	 * 
	 * Example:
	 * 
	 * Single button dropdown.
	 * ```php
	 * 
	 * <?php 
	 * echo bootui\Button::dropdown([
	 * 			'type'=> bootui\Button::TYPE_PRIMARY,
	 * 			'label'=>'button dropdown',
	 * 			'size'=>'lg',
	 * 			'items'=>[
	 * 				['label'=>'bootstrap','url'=>'http://getBootstrap.com'],
	 * 				'---',
	 * 				'Dropdown Header One',
	 * 				['label' => 'menu one','url'=>'#'],
	 * 				['label' => 'menu two','url'=>'#'],
	 * 				['label' => 'menu three','url'=>'#'],
	 * 				'Dropdown Header Two',
	 * 				['label' => 'menu four','url'=>'#'],
	 * 				['label' => 'menu five','url'=>'#']
	 * 				],
	 * ]);
	 * 
	 * ```
	 * 
	 * Split button dropdown.
	 * ```php
	 * 
	 * <?php 
	 * echo bootui\Button::dropdown([
	 * 			'type'=> bootui\Button::TYPE_SUCCESS,
	 * 			'label'=>'button dropdown',
	 * 			'size'=>'lg',
	 * 			'split' => true,
	 * 			'items'=>[
	 * 				['label'=>'bootstrap','url'=>'http://getBootstrap.com'],
	 * 				'---',
	 * 				'Dropdown Header One',
	 * 				['label' => 'menu one','url'=>'#'],
	 * 				['label' => 'menu two','url'=>'#'],
	 * 				['label' => 'menu three','url'=>'#'],
	 * 				'Dropdown Header Two',
	 * 				['label' => 'menu four','url'=>'#'],
	 * 				['label' => 'menu five','url'=>'#']
	 * 				],
	 * ]);
	 * 
	 * ```
	 * @param array $config
	 * @return string
	 */
	public static function dropdown($config)
	{
		return ButtonDropdown::widget($config);
	}
	
	/**
	 * Button Loading.
	 * Sets button state to loading - disables button and swaps text to loading text. Loading text should be defined on the button element.
	 * Config options in button loading:
	 * - `loadingText` is a text if button is loading.
	 * - `completeText` is a text if button is finish loading.
	 * - `loadingTimeOut` is a time to loading a button in second.
	 * - `completeTimeOut` is a time to complete loading a button in second.
	 * - `ajaxEvent` is a javascript event where button running ajax.
	 * 
	 * Loading button with array config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::loading([
	 *     'loadingText' => 'I am in loading now',
	 *     'completeText' => 'I am complete now',
	 *     'type' => bootui\Button::TYPE_SUCCESS,
	 *     'loadingTimeOut' => 5, // second.
	 *     'completeTimeOut' => 3, // second.
	 * ]);
	 * 
	 * ```
	 * 
	 * Loading button with string config.
	 * ```php
	 * 
	 * <?php
	 * echo bootui\Button::loading('loadingText:I am in loading now;completeText:I am complete now;type:primary;loadingTimeOut:5;completeTimeOut:3');
	 * 
	 * ```
	 * 
	 * @param array $config
	 * @return string
	 */
	public static function loading($config)
	{
		$config = static::prepareConfig($config);
		return ButtonLoading::widget($config);
	}
}
