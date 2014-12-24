<?php
namespace bootui;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

class BaseAlert extends Widget
{
	public $body;
	
	/**
	 * @var integer duration in second
	 */
	public $duration;
	
	public $closeButton = [];
	
	public $absolute = false;
	
	public $absoluteOptions;
	
	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();
	
		$this->initOptions();
	
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderBodyBegin() . "\n";
	}
	
	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo "\n" . $this->renderBodyEnd();
		echo "\n" . Html::endTag('div');
	
		$this->registerPlugin('alert');
		
		if(isset($this->duration))
			$this->duration();
	}
	
	/**
	 * Renders the close button if any before rendering the content.
	 * @return string the rendering result
	 */
	protected function renderBodyBegin()
	{
		return $this->renderCloseButton();
	}
	
	/**
	 * Renders the alert body (if any).
	 * @return string the rendering result
	 */
	protected function renderBodyEnd()
	{
		return $this->body . "\n";
	}
	
	/**
	 * Renders the close button.
	 * @return string the rendering result
	 */
	protected function renderCloseButton()
	{
		if ($this->closeButton !== null) {
			$tag = ArrayHelper::remove($this->closeButton, 'tag', 'button');
			$label = ArrayHelper::remove($this->closeButton, 'label', '&times;');
			if ($tag === 'button' && !isset($this->closeButton['type'])) {
				$this->closeButton['type'] = 'button';
			}
			return Html::tag($tag, $label, $this->closeButton);
		} else {
			return null;
		}
	}
	
	/**
	 * Initializes the widget options.
	 * This method sets the default values for various options.
	 */
	protected function initOptions()
	{
		Html::addCssClass($this->options, 'alert');
		Html::addCssClass($this->options, 'fade');
		Html::addCssClass($this->options, 'in');
		
		if ($this->absolute) {
			$absoluteOptions = isset($this->absoluteOptions) ? $this->absoluteOptions : null;
			$this->getView()->registerCss(".alert.absolute {position:absolute;z-index:1029;{$absoluteOptions}}");
			Html::addCssClass($this->options, 'absolute');
		}
	
		if ($this->closeButton !== null) {
			$this->closeButton = array_merge([
					'data-dismiss' => 'alert',
					'aria-hidden' => 'true',
					'class' => 'close',
					], $this->closeButton);
		}
	}
	
	protected function duration()
	{
		$duration = $this->duration * 1000;
		$id = ArrayHelper::getValue($this->options, 'id');
		$this->getView()->registerJs("setTimeout(function(){ jQuery('#{$id}').alert('close'); }, {$duration})");
	}
}