<?php
namespace bootui;

use \yii\helpers\Html;
/**
 * Button Dropdown renderer bootstrap dropdown button.
 * Config options in button dropdown:
 * `type` is a type of button valid value are 'default','primary','success','info','warning','danger'.
 * `item` is a list button dropdown.
 * `size` is a sizing button valid value are `lg`(Large),`sm`(Small),`xs`(Extra Small).
 * `split` is a whether to display a group of split-styled button group.
 * 
 * Example:
 * 
 * Single button dropdown.
 * ```php
 * 
 * <?php 
 * echo bootui\ButtonDropdown::widget([
 * 			'type'=>'success',
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
 * echo bootui\ButtonDropdown::widget([
 * 			'type'=>'success',
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
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class ButtonDropdown extends Widget
{
	/**
	 * @var array item list button dropdown.
	 */
	public $items = [];
	
	/**
	 * @var string type is a type of button valid value are 'default','primary','success','info','warning','danger'.
	 */
	public $type = 'default';
	
	/**
	 * @var array the HTML attributes of grouping the dropdown button.
	 */
	public $optionGroups = [];
	
	/**
	 * @var string the size button valid value are 'lg(Large)','sm(Small)','xs(Extra Small)'
	 */
	public $size;

	/**
	 * @var string the button label
	 */
	public $label = 'Button';
	/**
	 * @var array the HTML attributes of the button.
	 */
	public $options = [];
	/**
	 * @var array the configuration array for [[Dropdown]].
	 */
	public $dropdown = [];
	/**
	 * @var boolean whether to display a group of split-styled button group.
	 */
	public $split = false;
	/**
	 * @var string the tag to use to render the button
	 */
	public $tagName = 'button';
	/**
	 * @var boolean whether the label should be HTML-encoded.
	 */
	public $encodeLabel = true;
	/**
	 * @var boolean to set the dropdown items to drop up.
	 */
	public $dropup = false;
	
	/**
	 * Renders the widget.
	 */
	public function run()
	{
		$this->registerPlugin('button');
		return Html::beginTag('div', $this->optionGroups)."\n".$this->renderButton() . "\n" . $this->renderDropdown()."\n".Html::endTag('div');
	}
	
	/**
	 * Initialize the widget
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->optionGroups, 'btn-group');
		
		if ($this->dropup)
			Html::addCssClass($this->optionGroups, 'dropup');
		
		if (isset($this->items))
			$this->dropdown['items'] = $this->items;
		
		$this->type();
		$this->size();
	}
	
	/**
	 * render the type of button is a default, primary, success, info, warning, and danger
	 */
	protected function type()
	{
		$validValue = ['default','primary','success','info','warning','danger'];
		if(isset($this->type) and in_array($this->type, $validValue))
		{
			Html::addCssClass($this->options, 'btn-' . $this->type);
		}
	}
	
	/**
	 * render the size of button is a sm(Small), lg(Large), and xs(Extra Small)
	 */
	protected function size()
	{
		$validValue = ['lg','sm','xs'];
		if(isset($this->size) and in_array($this->size, $validValue))
		{
			Html::addCssClass($this->options, 'btn-' . $this->size);
		}
	}
	
	/**
	 * Generates the button dropdown.
	 * @return string the rendering result.
	 */
	protected function renderButton()
	{
		Html::addCssClass($this->options, 'btn');
		$label = $this->label;
		if ($this->encodeLabel) {
			$label = Html::encode($label);
		}
		if ($this->split) {
			$options = $this->options;
			$this->options['data-toggle'] = 'dropdown';
			Html::addCssClass($this->options, 'dropdown-toggle');
			$splitButton = Button::widget([
					'label' => '<span class="caret"></span>',
					'encodeLabel' => false,
					'options' => $this->options,
					'view' => $this->getView(),
					]);
		} else {
			$label .= ' <span class="caret"></span>';
			$options = $this->options;
			if (!isset($options['href'])) {
				$options['href'] = '#';
			}
			Html::addCssClass($options, 'dropdown-toggle');
			$options['data-toggle'] = 'dropdown';
			$splitButton = '';
		}
		return Button::widget([
				'tagName' => $this->tagName,
				'label' => $label,
				'options' => $options,
				'encodeLabel' => false,
				'view' => $this->getView(),
				]) . "\n" . $splitButton;
	}
	
	/**
	 * Generates the dropdown menu.
	 * @return string the rendering result.
	 */
	protected function renderDropdown()
	{
		$config = $this->dropdown;
		$config['jsOptions'] = false;
		$config['view'] = $this->getView();
		return Dropdown::widget($config);
	}
}