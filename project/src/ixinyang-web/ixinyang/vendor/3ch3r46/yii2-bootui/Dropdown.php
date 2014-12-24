<?php
namespace bootui;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use bootui\asset\DropdownAsset;

/**
 * Drodown is a class to use in navbar and button dropdown.
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class Dropdown extends Widget
{
	public $options = [];
	
	public $items = [];
	
	public $encodeLabels = false;
	
	public $right;
	
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'dropdown-menu');
		
		if (isset($this->right) && $this->right) {
			Html::addCssClass($this->options, 'dropdown-menu-right');
		}
	}
	
	public function run()
	{
		$this->registerPlugin('dropdown');
		DropdownAsset::register($this->getView());
		return $this->renderItems($this->items);
	}
	
	protected function renderItems($items)
	{
		$lines = [];
		foreach ($items as $i => $item) {
			// TODO check a item is visible or not.
			if (isset($item['visible']) && !$item['visible']) {
				unset($items[$i]);
				continue;
			}
			// TODO check a item is string.
			if (is_string($item)) {
				if ($item == '---')
					$lines[] = Html::tag('li', '', ['class'=>'divider']);
				else
					$lines[] = Html::tag('li',$item,['class'=>'dropdown-header']);
				continue;
			}
			// TODO check is not set a label, if not set throw invalid config exception.
			if (!isset($item['label'])) {
				throw new InvalidConfigException("The 'label' option is required.");
			}
			
			$label = $this->encodeLabels ? Html::encode($item['label']) : $item['label'];
			$options = ArrayHelper::getValue($item, 'options', []);
			$linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
			
			// TODO check a item is disabled or no.
			if (isset($item['disable']) && $item['disable']) {
				Html::addCssClass($options, 'disabled');
			}
			
			$subcontent = '';
			if (isset($item['items'])) {
				$subcontent = $this->renderItems($item['items']);
				Html::addCssClass($options, 'dropdown dropdown-submenu');
				$linkOptions['data-toggle'] = 'dropdown';
			}
			
			$linkOptions['tabindex'] = '-1';
			$content = Html::a($label, ArrayHelper::getValue($item, 'url', '#'), $linkOptions);
			$lines[] = Html::tag('li', $content . $subcontent, $options);
		}

		return Html::tag('ul', implode("\n", $lines), $this->options);
	}
}