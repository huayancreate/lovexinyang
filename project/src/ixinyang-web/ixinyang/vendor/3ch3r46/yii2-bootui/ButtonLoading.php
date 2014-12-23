<?php
namespace bootui;
/**
 * ButtonLoading renderer bootstrap loading button.
 * Config options in button loading:
 * `loadingText` is a text if button is loading.
 * `completeText` is a text if button is finish loading.
 * `loadingTimeOut` is a time to loading a button in second.
 * `completeTimeOut` is a time to complete loading a button in second.
 * `ajaxEvent` is a javascript event where button running ajax.
 * 
 * Example:
 * ```php
 * 
 * <?php
 * echo bootui\ButtonLoading::widget([
 *     'loadingText' => 'I am in loading now',
 *     'completeText' => 'I am complete now',
 *     'type' => 'primary',
 *     'loadingTimeOut' => 5, // second.
 *     'completeTimeOut' => 3, // second.
 * ]);
 * 
 * ```
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class ButtonLoading extends Button
{
	public $loadingText = 'Loading . . .';
	
	public $completeText = 'Complete . . .';
	
	public $loadingTimeOut = 5;
	
	public $completeTimeOut = 2;
	
	public $ajaxEvent = [];
	
	protected function initOptions()
	{
		parent::initOptions();
		
		$this->options['data-loading-text'] = $this->loadingText;
		$this->options['data-complete-text'] = $this->completeText;
		
		if (!empty($this->ajaxEvent)) {
			$ajaxEvent = JSON::encode($this->ajaxEvent);
			// Register the event button loading
			$this->jsEvents['click'] = "function(){ var btn = $(this); btn.button('loading'); $.ajax({$ajaxEvent}).always(function () { btn.button('reset'); }); }";
		} else {
			$loadingTimeout = $this->loadingTimeOut * 1000;
			$completeTimeout = $loadingTimeout + ($this->completeTimeOut * 1000);
			// Register the event button loading
			$this->jsEvents['click'] = "function(){ var btn = $(this); btn.button('loading'); setTimeout(function(){ btn.button('complete'); }, {$loadingTimeout}); setTimeout(function(){ btn.button('reset'); }, {$completeTimeout}); }";
		}
	}
}