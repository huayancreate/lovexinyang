<?php
namespace bootui;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
/**
 * ListGroup renderer bootstrap List Group.
 * List groups are a flexible and powerful component for displaying not only simple lists of elements, 
 * but complex ones with custom content. The most basic list group is simply an unordered list with list items, 
 * and the proper classes
 * 
 * Config options this widget:
 * - `items` is an array list item. See items option.
 * - `type` is bootstrap list group type `success`, `info`, `warning`, and `danger`.
 * - `icon` is a bootstrap glyphicon and set to all list group item.
 * 
 * Item Config Options.
 * - `label` is string or array to render a content in list item. custom content with `heading` and `text`.
 * - `url`to linkify list group items by using anchor tags instead of list items.
 * - `badge` to add the badges component to this list group item and it will automatically be positioned on the right.
 * - `icon` is a bootstrap glyphicon and set to this list group item.
 * 
 * For Example : 
 * 
 * ```php
 * <?php
 * echo ListGroup::widget(['items' => [
 * 	 	'Morbi leo risus', // in string mode will render a label.
 * 	 	[
 * 			'icon' => 'globe',
 * 	 		'label' => 'Porta ac consectetur ac',
 * 			'url' => 'http://brother.com',
 * 			'type' => ListGroup::TYPE_WARNING,
 * 	 	],
 * 	 	'heading=first Heading,text=Cras justo odio', // will render a label with heading and text.
 * 		'label:heading=Second Heading,text=Dapibus ac facilisis in;url:http://brother.com',
 * 		[
 * 			'label' => [
 * 				'heading' => 'Third Heading',
 * 				'text' => 'Vestibulum at eros'
 *  		],
 *  		'badge' => 46,
 * 	 	]
 *   ],
 *   'type' => ListGroup::TYPE_INFO
 * ]);
 * ```
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class ListGroup extends Widget
{
	//list group type
	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_DANGER = 'danger';
	/**
	 * @var array of list items.
	 */
	public $items = [];
	/**
	 * @var string type of list group.
	 */
	public $type;
	/**
	 * @var string icon
	 */
	public $icon;
	
	/**
	 * initialize widgets(non-PHPdoc)
	 * @see CWidget::init()
	 */
	public function init(){
		Html::addCssClass($this->options, 'list-group');
	}
	/**
	 * Create the list
	 */
	public function createList(){
		$lines = [];
		
		foreach ($this->items as $item) {
			$lines[] = $this->createListItem(static::prepareConfig($item));
		}
		return implode('', $lines);
	}
	
	protected function createListItem($item)
	{
		$text=null;
			
		$icon=null;
			
		// Check Icon Set
		if (isset($this->icon))
			$icon = $this->icon;
			
		// Check Icon Set
		if (isset($item['icon']))
			$icon = $item['icon'];
			
		// UnSet Icon
		if (isset($item['icon']) and $item['icon']==false)
			unset($icon);
		
		if (isset($item['label'])) {
			if (is_array($item['label']))
			{
				if (isset($item['label']['heading'])) {
					if (isset($icon)) {
						$item['label']['heading']=$this->icon($icon) . ' ' . $item['label']['heading'];
						unset($icon);
					}
		
					if (isset($item['badge'])) {
						$item['label']['heading'] .= Html::tag('span', $item['badge'], ['class' => 'badge pull-right']);
						unset($item['badge']);
					}
						
					$text .= Html::tag('h4', $item['label']['heading'], ['class' => 'list-group-item-heading']);
		
				}
		
				if (isset($item['label']['text']))
					$text .= Html::tag('p', $item['label']['text'], ['class' => 'list-group-item-text']);
		
			} else {
				$text = $item['label'];
				if (isset($icon))
					$text = $this->icon($icon) . ' ' . $text;
		
				if (isset($item['badge']))
					$text .= Html::tag('span', $item['badge'], ['class' => 'badge']);
			}
		
		} elseif (isset($item['heading'])) {
			$text = $item['heading'];
			if (isset($icon))
				$text = $this->icon($icon) . ' ' . $text;
		}
			
		$options = isset($item['options']) ? $item['options'] : [];
		Html::addCssClass($options, 'list-group-item');
		
		if (isset($item['type'])) {
			Html::addCssClass($options, 'list-group-item-' . ArrayHelper::remove($item, 'type'));
		} elseif (!isset($item['type']) && isset($this->type)) {
			Html::addCssClass($options, 'list-group-item-' . $this->type);
		}
			
		if (isset($item['active']) and $item['active']==true)
			Html::addCssClass($options, 'active');
		if (isset($item['url'])) {
			if (is_array($item['url']))
				$url = \Yii::$app->urlManager->createUrl($item['url']);
			else $url = $item['url'];
		} else {
			$url=null;
		}
		if (isset($item['label']))
			return Html::a($text, $url, $options);
		elseif (isset($item['heading']))
			return Html::tag('span', $text, $options);
	}
	
	public function icon($icon)
	{
		return Html::tag('i', '', ['class' => 'glyphicon glyphicon-' . $icon]);
	}
	
	/**
	 * runt this widgets(non-PHPdoc)
	 * @see Widget::run()
	 */
	public function run(){
		return Html::tag('div', $this->createList(), $this->options);
	}
}