<?php
namespace bootui;

class Alert extends Widget
{
	public $alertTypes = [
		'error'   => 'danger',
		'danger'  => 'danger',
		'success' => 'success',
		'info'    => 'info',
		'warning' => 'warning'
	];
	
	public $closeButton = [];
	
	public $absolute = false;
	
	public $absoluteOptions;
	
	public $duration;
	
	public function init()
	{
		parent::init();
		
		$session = \Yii::$app->getSession();
		$flashes = $session->getAllFlashes();
		$appendCss = isset($this->options['class']) ? ' ' . $this->options['class'] : '';
		
		foreach ($flashes as $type => $message) {
			/* initialize css class for each alert box */
			$this->options['class'] = 'alert-' . $this->alertTypes[$type] . $appendCss;

			/* assign unique id to each alert box */
			$this->options['id'] = $this->getId() . '-' . $type;

			echo BaseAlert::widget([
				'absolute' => $this->absolute,
				'duration' => $this->duration,
				'absoluteOptions' => $this->absoluteOptions,
				'body' => $message,
				'closeButton' => $this->closeButton,
				'options' => $this->options
			]);

			$session->removeFlash($type);
		}
	}
		
	/**
	 * Renders the widget.
	 */
	public function run()
	{
		$this->registerPlugin('alert');
	}
}
