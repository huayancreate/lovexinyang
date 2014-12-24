<?php
namespace bootui;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
/**
 * Progress bar renderer bootstrap progress bar.
 * Provide up-to-date feedback on the progress of a workflow or action with simple yet flexible progress bars.
 * 
 * Config Options:
 * - `animate` set true to use animation in progress bar.
 * - `type` the progress bar type. valid value are 'success','info','warning','danger'.
 * - `striped` set the progress bar is striped or not with boolean(`true`|`false`).
 * - `label` the progress bar caption.
 * - `percent` integer the amount of progress as a percentage.
 * 
 * Example : 
 * ```php
 * <?php
 * echo bootui\Progress::widget([
 * 		'label' => 'Progress bar is running with animation',
 * 		'animate' => true, 
 * 		'percent' => 50, 
 * 		'striped' => true, 
 * 		'type' => bootui\Progress::TYPE_SUCCESS,
 * ]);
 * ```
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class Progress extends Widget
{
	//list group type
	const TYPE_INFO = 'info';
	const TYPE_SUCCESS = 'success';
	const TYPE_WARNING = 'warning';
	const TYPE_DANGER = 'danger';
	/**
	 * @var boolean to use animation in progress bar.
	 */
	public $animate = false;
	/**
	 * @var string the progress bar type. valid value are 'success','info','warning','danger'.
	 */
	public $type;
	/**
	 * @var boolean the progress bar is striped or not.
	 */
	public $striped = false;
	/**
	 * @var string the progress bar hint label
	 */
	public $label;
	/**
	 * @var integer the amount of progress as a percentage.
	 */
	public $percent = 0;
	/**
	 * @var array the HTML attributes of the bar
	 */
	public $barOptions = [];
	/**
	 * @var array a set of bars that are stacked together to form a single progress bar.
	 */
	public $bars;


	/**
	 * Initializes the widget.
	 * If you override this method, make sure you call the parent implementation first.
	 */
	public function init()
	{
		parent::init();
		Html::addCssClass($this->options, 'progress');
		
		$this->renderType();
		$this->renderTheme();
	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		echo Html::beginTag('div', $this->options) . "\n";
		echo $this->renderProgress() . "\n";
		echo Html::endTag('div') . "\n";
	}
	
	/**
	 * Render the progress bar type
	 */
	protected function renderType()
	{
		$validValue = ['success','info','warning','danger'];
		if (isset($this->type) && in_array($this->type, $validValue)) {
			Html::addCssClass($this->barOptions, 'progress-bar-'.$this->type);
		}
	}
	
	/**
	 * Render the progress bar theme.
	 */
	protected function renderTheme()
	{
		if ($this->striped) {
			Html::addCssClass($this->options, 'progress-striped');
		}
		
		if ($this->animate) {
			Html::addCssClass($this->options, 'active');
		}
	}

	/**
	 * Renders the progress.
	 * @return string the rendering result.
	 * @throws InvalidConfigException if the "percent" option is not set in a stacked progress bar.
	 */
	protected function renderProgress()
	{
		if (empty($this->bars)) {
			return $this->renderBar($this->percent, $this->label, $this->barOptions);
		}
		$bars = [];
		foreach ($this->bars as $bar) {
			$label = ArrayHelper::getValue($bar, 'label', '');
			if (!isset($bar['percent'])) {
				throw new InvalidConfigException("The 'percent' option is required.");
			}
			$options = ArrayHelper::getValue($bar, 'options', []);
			$bars[] = $this->renderBar($bar['percent'], $label, $options);
		}
		return implode("\n", $bars);
	}

	/**
	 * Generates a bar
	 * @param int $percent the percentage of the bar
	 * @param string $label, optional, the label to display at the bar
	 * @param array $options the HTML attributes of the bar
	 * @return string the rendering result.
	 */
	protected function renderBar($percent, $label = '', $options = [])
	{
		$defaultOptions = [
			'role' => 'progressbar',
			'aria-valuenow' => $percent,
			'aria-valuemin' => 0,
			'aria-valuemax' => 100,
			'style' => "width:{$percent}%",
		];
		$options = array_merge($defaultOptions, $options);
		Html::addCssClass($options, 'progress-bar');

		$out = Html::beginTag('div', $options);
		$out .= $label;
		$out .= Html::tag('span', \Yii::t('yii', '{percent}% Complete', ['percent' => $percent]), [
				'class' => 'sr-only'
				]);
		$out .= Html::endTag('div');
		return $out;
	}
}