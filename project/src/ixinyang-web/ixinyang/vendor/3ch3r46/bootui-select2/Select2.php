<?php
namespace bootui\select2;

use Yii;
use yii\helpers\Html;
use yii\widgets\InputWidget;
/**
 * Bootstrap select2
 * -----------------
 * 
 * example code: 
 * ~~~
 * <?php
 * echo Select2::widget([
 * 	'name' => 'selection-name', 
 * 	'value' => 'first',
 * 	'items' => ['first' => 'First Option', 'second' => 'Second Option', 'third' => 'Third Option'], 
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Select']
 * ]);
 * 
 * echo $form->field($model, 'attribute')->widget(Select2::className(), [
 * 	'items' => ['first' => 'First Option', 'second' => 'Second Option', 'third' => 'Third Option'], 
 * 	'options' => ['class' => 'form-control'],
 * 	'addon' => ['prepend' => 'Select']
 * ]);
 * ~~~
 * 
 * More property see http://ivaynberg.github.io/select2/#documentation
 * example `function` or `object` type : 
 * ~~~
 * <?php
 * echo Select2::widget([
 * 	//jquery inline function
 * 	'formatResult' => 'function format(state) { if (!state.id) return state.text;return "<img class='flag' src='images/flags/" + state.id.toLowerCase() + ".png'/>" + state.text;}',
 * 	//call existing function
 * 	'formatSelection' => 'js:formatSelection()',
 * 	//object
 * 	'data' => 'js:[{id:0,text:'enhancement'},{id:1,text:'bug'},{id:2,text:'duplicate'},{id:3,text:'invalid'},{id:4,text:'wontfix'}]',
 * ]);
 * ~~~
 * 
 * @property boolean $multiple set the dropdownlist to multiple selection.
 * @property string $size
 * @property string $language
 * @property array $addon
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 * @see http://ivaynberg.github.io/select2/
 */
class Select2 extends InputWidget
{
	const LARGE = 'lg';
	const SMALL = 'sm';
	
	protected $clientOptions = [];
	
	public $multiple = false;
	
	public $language;
	
	public $size;
	
	public $addon = [];
	
	/**
	 * @var array the event handlers for the underlying Select2 Javascript plugin.
	 * Please refer to the corresponding Bootstrap plugin Web page for possible events.
	 */
	public $events = [];
	
	protected $hasGroup = false;

	public $groupOptions = [
		'class' => 'input-group input-group-select',
	];
	/**
	 * @var array the option data items. The array keys are option values, and the array values
     * are the corresponding option labels. The array can also be nested (i.e. some array values are arrays too).
     * For each sub-array, an option group will be generated whose label is the key associated with the sub-array.
     * If you have a list of data models, you may convert them into the format described above using
     * [[\yii\helpers\ArrayHelper::map()]].
     *
     * Note, the values and labels will be automatically HTML-encoded by this method, and the blank spaces in
     * the labels will also be HTML-encoded.
     * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
     *
     * - prompt: string, a prompt text to be displayed as the first option;
     * - options: array, the attributes for the select option tags. The array keys must be valid option values,
     *   and the array values are the extra attributes for the corresponding option tags. For example,
     *
     *   ~~~
     *   [
     *       'value1' => ['disabled' => true],
     *       'value2' => ['label' => 'value 2'],
     *   ];
     *   ~~~
     *
     * - groups: array, the attributes for the optgroup tags. The structure of this is similar to that of 'options',
     *   except that the array keys represent the optgroup labels specified in $items.
     *
     * The rest of the options will be rendered as the attributes of the resulting tag. The values will
     * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
     * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 */
	public $items = [];
	
	public function __set($name, $value)
	{
		if (isset($this->{$name}))
			parent::__set($name, $value);
		else
			$this->clientOptions[$name] = $value;
	}
	
	public function init()
	{
		if (!empty($this->addon))
			$this->hasGroup = true;
		
		if (isset($this->addon['append']) && !isset($this->addon['prepend']))
			Html::addCssClass($this->options, 'in-left');

		if (isset($this->addon['prepend']) && !isset($this->addon['append']))
			Html::addCssClass($this->options, 'in-right');
		
		if (isset($this->size) && in_array($this->size, ['lg', 'sm'])) {
			Html::addCssClass($this->options, 'input-' . $this->size);
		}
		parent::init();
	}
	
	public function run()
	{
		$this->registerPlugin();
		return $this->renderInput();
	}
	
	public function renderInput()
	{
		if ($this->multiple)
		{
			$this->options['multiple'] = 'multiple';
		}
		
		if ($this->hasModel()) {
			$input = Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
		} else {
			$input = Html::dropDownList($this->name, $this->value, $this->items, $this->options);
		}
		
		if ($this->hasGroup)
			$input = Html::tag('div', $this->prepareAddon($input), $this->groupOptions);
		
		return $input;
	}
	
	protected function prepareAddon($input)
	{
		extract($this->addon);
		
		$template = "{prepend}\n{input}\n{append}";
		$appendContent = [];
		$prependContent = [];
		
		if (isset($append)) {
			if (is_array($append)) {
				if (is_string($append[0]) && is_bool($append[1])) {
					if ($append[1] == true)
						$appendContent[] = Html::tag('span', $append[0], ['class' => 'input-group-btn']);
				} else {
					foreach ($append as $content) {
						$appendContent[] = $this->prepareContent($content);
					}
				}
			} else {
				$appendContent[] = Html::tag('span', $append, ['class' => 'input-group-addon']);
			}
		}
		if (isset($prepend)) {
			if (is_array($prepend)) {
				if (is_string($prepend[0]) && is_bool($prepend[1])) {
					if ($prepend[1] == true)
						$prependContent[] = Html::tag('span', $prepend[0], ['class' => 'input-group-btn']);
				} else {
					foreach ($prepend as $content) {
						$prependContent[] = $this->prepareContent($content);
					}
				}
			} else {
				$prependContent[] = Html::tag('span', $prepend, ['class' => 'input-group-addon']);
			}
		}
		
		return strtr($template, [
				'{prepend}' => implode('', $prependContent),
				'{input}' => $input,
				'{append}' => implode('', $appendContent),
		]);
	}
	
	protected function prepareContent($content)
	{
		if (is_array($content)) {
			if (!isset($content['class']) && isset($content[0]))
				$content['class'] = ArrayHelper::remove($content, 0);
			if (!isset($content['options']) && isset($content[1])) {
				if (is_bool($content[1]))
					$content['asButton'] = ArrayHelper::remove($content, 1);
				else
					$content['options'] = ArrayHelper::remove($content, 1);
			}
			if (!isset($content['asButton']))
				$content['asButton'] = ArrayHelper::remove($content, 2, false);
			$class = $content['class'];
			$options = isset($content['options']) ? $content['options'] : [];
			$asButton = $content['asButton'];
			
			if ($asButton)
				Html::addCssClass($tagOptions, 'input-group-btn');
			else 
				Html::addCssClass($tagOptions, 'input-group-addon');
			
			if (class_exists($class)) {
				$inContent = $class::widget($options);
			} else {
				$inContent = $class;
			}
			
			$content = Html::tag('span', $inContent, $tagOptions);
		} else {
			if ($content instanceof Widget)
				Html::addCssClass($tagOptions, 'input-group-btn');
			else
				Html::addCssClass($tagOptions, 'input-group-addon');
			$content = Html::tag('span', $content, $tagOptions);
		}
		return $content;
	}
	
	protected function registerPlugin()
	{
		$view = $this->getView();
		if (isset($this->language))
			Select2Asset::register($view)->js[] = 'select2_locale_' . $this->language . '.js';
		else 
			Select2Asset::register($view);
		
		$selector = $this->options['id'];
		
		$options = !empty($this->clientOptions) ? JSON::encode($this->clientOptions) : '';
		
		$view->registerJs("jQuery('#$selector').select2({$options});");
		
		if (!empty($this->events)) {
			$js = [];
			foreach ($this->jsEvents as $event => $handler) {
				$js[] = "jQuery('#$selector').on('$event', $handler);";
			}
			$view->registerJs(implode("\n", $js));
		}
	}
	
	public static function listData($model, $keyName, $valueName)
	{
		$data = [];
		$provider = new ActiveDataProvider(['query' => $model::find(), 'pagination' => false]);
		foreach ($provider->getModels() as $model)
		{
			$data[$model->{$keyName}] = $model->{$valueName};
		}
		return $data;
	}
}
