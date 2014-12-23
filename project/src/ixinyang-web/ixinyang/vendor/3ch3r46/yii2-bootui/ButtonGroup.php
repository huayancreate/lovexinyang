<?php
namespace bootui;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
 * ButtonGroup renderer bootstrap grouping buttons.
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
 * Example in default:
 * ```php
 * 
 * <?php 
 * echo bootui\ButtonGroup::widget([
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
 * Example with button object:
 * 
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
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class ButtonGroup extends Widget
{
	public $buttons = [];
	/**
	 * @var boolean whether to HTML-encode the button labels.
	 */
	public $encodeLabels = true;
	
	public $hasInputGroup = false;
	
	public $vertical = false;
	
	public $justified = false;
	
	public $size;
	
	public $block;
	
	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		
		$this->hasInputGroup ? Html::addCssClass($this->options, "input-group-btn") : Html::addCssClass($this->options, "btn-group");
				
		$this->initOptions();
	}
	
	/**
	 * Renders the widget.
	 */
	public function run()
	{
		return Html::tag('div', $this->renderButtons(), $this->options);
	}
	
	/**
	 * Generates the buttons that compound the group as specified on [[items]].
	 * @return string the rendering result.
	 */
	protected function renderButtons()
	{
		$buttons = [];
		foreach ($this->buttons as $button) {
			if (is_array($button)) {
				$label = ArrayHelper::getValue($button, 'label');
				$options = ArrayHelper::getValue($button, 'options');
				$optionGroups = ArrayHelper::getValue($button, 'optionGroups');
				$url = ArrayHelper::getValue($button, 'url', null);
				$addOptions = [];
				
				if (!empty($url))
					$addOptions['url'] = $url;
				
				if(isset($this->size) && in_array($this->size, ['xs','sm','lg']))
				{
					Html::addCssClass($optionGroups, 'btn-group-'.$this->size);
				}
				
				if (isset($button['items'])) {
					$buttons[] = ButtonDropdown::widget(array_merge([
						'label' => $label,
						'options' => $options,
						'optionGroups' => $optionGroups,
						'items' => ArrayHelper::getValue($button, 'items'),
						'encodeLabel' => $this->encodeLabels,
						'view' => $this->getView()
						], $addOptions));
				} else {
					$buttons[] = Button::widget(array_merge([
						'label' => $label,
						'options' => $options,
						'encodeLabel' => $this->encodeLabels,
						'view' => $this->getView(),
						], $addOptions));
				}
			} else {
				$buttons[] = $button;
			}
		}
		return implode("\n", $buttons);
	}
	
	protected function initOptions()
	{
		if($this->vertical)
		{
			Html::removeCssClass($this->options, 'btn-group');
			Html::addCssClass($this->options, 'btn-group-vertical');
		}
		
		if($this->justified)
		{
			Html::addCssClass($this->options, 'btn-group-justified');
		}
		
		if(isset($this->size) && in_array($this->size, ['xs','sm','lg']))
		{
			Html::addCssClass($this->options, 'btn-group-'.$this->size);
		}
		
		if (isset($this->block) && $this->block)
		{
			Html::addCssClass($this->options, 'btn-block');
		}
	}
}