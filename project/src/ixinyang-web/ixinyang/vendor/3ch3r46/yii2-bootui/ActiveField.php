<?php
namespace bootui;

use yii\base\InvalidParamException;

use yii\base\Object;

use yii\helpers\ArrayHelper;

use yii\base\InvalidConfigException;

/**
 * ActiveField Class file.
 * Custom ActiveField using bootstrap ActiveField
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class ActiveField extends \yii\widgets\ActiveField
{
	// Type of bootstrap form
	const HORIZONTAL = 'horizontal';
	const VERTICAL = 'vertical';
	const INLINE = 'inline';
	
	/**
	 * Tipe form is a HORIZONTAL, VERTICAL, or INLINE
	 * @var string
	 */
	public $formType = 'vertical';
	
	/**
	 * Sizing form control
	 * @var string
	 */
	public $_size;
	
	/**
	 * @var boolean to enable or disable label left align
	 */
	public $leftLabel = false;
	
	/**
	 * @var boolean if this field have a append or prepend input box.
	 */
	protected $hasapprepend = false;
	
	/**
	 * @var array for input type option
	 */
	private $inputTypes = [
		'activeTextInput', 
		'activePasswordInput', 
		'activeTextarea', 
		'activeHiddenInput', 
		'activeFileInput'
	];
	
	/**
	 * @var array for input list option
	 */
	private $inputListTypes = [
		'activeCheckboxList', 
		'activeRadioList'
	];
	
	/**
	 * @var array for combobox or listbox option
	 */
	private $inputDropdownTypes = [
		'activeDropDownList', 
		'activeListBox'
	];
	
	/**
	 * @var array for widget option
	 */
	private $inputWidgetTypes = [
		'Datepicker',
	];
	
	/**
	 * @var array default config input options
	 */
	private $input_options = [
		'type' => 'activeTextInput'
	];
	
	/**
	 * @var array is a config for list option
	 */
	public $listOptions = [];
	
	/**
	 * @var string for wrapper grid system bootstrap for form label control.
	 */
	public $_wrap_label = 'col-sm-3';
	
	/**
	 * @var string for wrapper grid system bootstrap for form input control.
	 */
	public $_wrap_input = 'col-sm-6';
	
	/**
	 * @var boolean to set the form control is inline.
	 */
	public $_inline = false;
	
	/**
	 * @var boolean to set the radio List or checkbox list to bootstrap button checkbox or radio toggle.
	 */
	public $_isButton = false;
	
	/**
	 * @var boolean to set the radio List or checkbox list to bootstrap button checkbox or radio toggle in vertical mode.
	 */
	public $_isButtonVertical = false;
	
	/**
	 * Renders an input tag.
	 * @param string $type the input type (e.g. 'text', 'password')
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function input($type, $options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => $type, 'inputOnly' => true];
		
		return $this;
	}

	/**
	 * Renders a Static Box.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function staticBox($options = [])
	{
		$options = ArrayHelper::merge($this->inputOptions, $options);
		Htmll::addCssClass($options, 'form-control-static');
		$this->parts['{input}'] = Html::tag('p', Html::getAttributeValue($this->model, $this->attribute), $options);
		
		return $this;
	}
	
	/**
	 * Renders a text input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function textInput($options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => 'activeTextInput'];
		
		return $this;
	}
	
	/**
	 * Renders a hidden input.
	 *
	 * Note that this method is provided for completeness. In most cases because you do not need
	 * to validate a hidden input, you should not need to use this method. Instead, you should
	 * use [[\yii\helpers\Html::activeHiddenInput()]].
	 *
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function hiddenInput($options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);

		$this->template = "{input}";
		$this->input_options = ['type' => 'activeHiddenInput'];
	
		return $this;
	}
	
	/**
	 * Renders a password input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function passwordInput($options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => 'activePasswordInput'];
	
		return $this;
	}
	
	/**
	 * Renders a file input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function fileInput($options = [])
	{
		// https://github.com/yiisoft/yii2/pull/795
		
		if ($this->inputOptions !== ['class' => 'form-control']) {
			$this->inputOptions = array_merge($this->inputOptions, $options);
		}
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => 'activeFileInput'];
		
		return $this;
	}
	
	/**
	 * Renders a text area.
	 * The model attribute value will be used as the content in the textarea.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function textarea($options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => 'activeTextarea'];
	
		return $this;
	}
	
	/**
	 * Renders a radio button.
	 * This method will generate the "checked" tag attribute according to the model attribute value.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the radio button. If not set,
	 *   it will take the default value '0'. This method will render a hidden input so that if the radio button
	 *   is not checked and is submitted, the value of this attribute will still be submitted to the server
	 *   via the hidden input.
	 * - label: string, a label displayed next to the radio button.  It will NOT be HTML-encoded. Therefore you can pass
	 *   in HTML code such as an image tag. If this is is coming from end users, you should [[Html::encode()]] it to prevent XSS attacks.
	 *   When this option is specified, the radio button will be enclosed by a label tag.
	 * - labelOptions: array, the HTML attributes for the label tag. This is only used when the "label" option is specified.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will
	 * be HTML-encoded using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * @param boolean $enclosedByLabel whether to enclose the radio within the label.
	 * If true, the method will still use [[template]] to layout the checkbox and the error message
	 * except that the radio is enclosed by the label tag.
	 * @return static the field object itself
	 */
	public function radio($options = [], $enclosedByLabel = true)
	{
		if ($enclosedByLabel) {
			if (!isset($options['label'])) {
				$attribute = Html::getAttributeName($this->attribute);
				$options['label'] = Html::encode($this->model->getAttributeLabel($attribute));
			}
			$this->listOptions = array_merge($this->listOptions, $options);
			$this->input_options = ['type' => 'activeRadio', 'onlyOne' => true];

			$this->parts['{label}'] = '';
		} else {
			$this->listOptions = array_merge($this->listOptions, $options);
			$this->input_options = ['type' => 'activeRadio', 'onlyOne' => true];
		}
		$this->adjustLabelFor($options);
	
		return $this;
	}
	
	/**
	 * Renders a checkbox.
	 * This method will generate the "checked" tag attribute according to the model attribute value.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the radio button. If not set,
	 *   it will take the default value '0'. This method will render a hidden input so that if the radio button
	 *   is not checked and is submitted, the value of this attribute will still be submitted to the server
	 *   via the hidden input.
	 * - label: string, a label displayed next to the checkbox.  It will NOT be HTML-encoded. Therefore you can pass
	 *   in HTML code such as an image tag. If this is is coming from end users, you should [[Html::encode()]] it to prevent XSS attacks.
	 *   When this option is specified, the checkbox will be enclosed by a label tag.
	 * - labelOptions: array, the HTML attributes for the label tag. This is only used when the "label" option is specified.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will
	 * be HTML-encoded using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * @param boolean $enclosedByLabel whether to enclose the checkbox within the label.
	 * If true, the method will still use [[template]] to layout the checkbox and the error message
	 * except that the checkbox is enclosed by the label tag.
	 * @return static the field object itself
	 */
	public function checkbox($options = [], $enclosedByLabel = true)
	{
		if ($enclosedByLabel) {
			if (!isset($options['label'])) {
				$attribute = Html::getAttributeName($this->attribute);
				$options['label'] = Html::encode($this->model->getAttributeLabel($attribute));
			}
			
			$this->listOptions = array_merge($this->listOptions, $options);
			$this->input_options = ['type' => 'activeCheckbox', 'onlyOne' => true];

			$this->parts['{label}'] = '';
		} else {
			$this->listOptions = array_merge($this->listOptions, $options);
			$this->input_options = ['type' => 'activeCheckbox', 'onlyOne' => true];
		}
		$this->adjustLabelFor($options);
	
		return $this;
	}
	
	/**
	 * Renders a drop-down list.
	 * The selection of the drop-down list is taken from the value of the model attribute.
	 * @param array $items the option data items. The array keys are option values, and the array values
	 * are the corresponding option labels. The array can also be nested (i.e. some array values are arrays too).
	 * For each sub-array, an option group will be generated whose label is the key associated with the sub-array.
	 * If you have a list of data models, you may convert them into the format described above using
	 * [[ArrayHelper::map()]].
	 *
	 * Note, the values and labels will be automatically HTML-encoded by this method, and the blank spaces in
	 * the labels will also be HTML-encoded.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - prompt: string, a prompt text to be displayed as the first option;
	 * - options: array, the attributes for the select option tags. The array keys must be valid option values,
	 *   and the array values are the extra attributes for the corresponding option tags. For example,
	 *
	 * ~~~
	 * [
	 *     'value1' => ['disabled' => true],
	 *     'value2' => ['label' => 'value 2'],
	 * ];
	 * ~~~
	 *
	 * - groups: array, the attributes for the optgroup tags. The structure of this is similar to that of 'options',
	 *   except that the array keys represent the optgroup labels specified in $items.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will
	 * be HTML-encoded using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 *
	 * @return static the field object itself
	 */
	public function dropDownList($items, $options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => 'activeDropDownList', 'items' => $items];
	
		return $this;
	}
	
	/**
	 * Renders a list box.
	 * The selection of the list box is taken from the value of the model attribute.
	 * @param array $items the option data items. The array keys are option values, and the array values
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
	 * ~~~
	 * [
	 *     'value1' => ['disabled' => true],
	 *     'value2' => ['label' => 'value 2'],
	 * ];
	 * ~~~
	 *
	 * - groups: array, the attributes for the optgroup tags. The structure of this is similar to that of 'options',
	 *   except that the array keys represent the optgroup labels specified in $items.
	 * - unselect: string, the value that will be submitted when no option is selected.
	 *   When this attribute is set, a hidden field will be generated so that if no option is selected in multiple
	 *   mode, we can still obtain the posted unselect value.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting tag. The values will
	 * be HTML-encoded using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 *
	 * @return static the field object itself
	 */
	public function listBox($items, $options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => 'activeListBox', 'items' => $items];
	
		return $this;
	}
	
	/**
	 * Renders a list of checkboxes.
	 * A checkbox list allows multiple selection, like [[listBox()]].
	 * As a result, the corresponding submitted value is an array.
	 * The selection of the checkbox list is taken from the value of the model attribute.
	 * @param array $items the data item used to generate the checkboxes.
	 * The array values are the labels, while the array keys are the corresponding checkbox values.
	 * Note that the labels will NOT be HTML-encoded, while the values will.
	 * @param array $options options (name => config) for the checkbox list. The following options are specially handled:
	 *
	 * - unselect: string, the value that should be submitted when none of the checkboxes is selected.
	 *   By setting this option, a hidden input will be generated.
	 * - separator: string, the HTML code that separates items.
	 * - item: callable, a callback that can be used to customize the generation of the HTML code
	 *   corresponding to a single item in $items. The signature of this callback must be:
	 *
	 * ~~~
	 * function ($index, $label, $name, $checked, $value)
	 * ~~~
	 *
	 * where $index is the zero-based index of the checkbox in the whole list; $label
	 * is the label for the checkbox; and $name, $value and $checked represent the name,
	 * value and the checked status of the checkbox input.
	 * @return static the field object itself
	 */
	public function checkboxList($items, $options = [])
	{
		$this->adjustLabelFor($options);
		$this->listOptions = array_merge($this->listOptions, $options);
		$this->input_options = ['type' => 'activeCheckboxList', 'items' => $items];
	
		return $this;
	}
	
	/**
	 * Renders a list of radio buttons.
	 * A radio button list is like a checkbox list, except that it only allows single selection.
	 * The selection of the radio buttons is taken from the value of the model attribute.
	 * @param array $items the data item used to generate the radio buttons.
	 * The array keys are the labels, while the array values are the corresponding radio button values.
	 * Note that the labels will NOT be HTML-encoded, while the values will.
	 * @param array $options options (name => config) for the radio button list. The following options are specially handled:
	 *
	 * - unselect: string, the value that should be submitted when none of the radio buttons is selected.
	 *   By setting this option, a hidden input will be generated.
	 * - separator: string, the HTML code that separates items.
	 * - item: callable, a callback that can be used to customize the generation of the HTML code
	 *   corresponding to a single item in $items. The signature of this callback must be:
	 *
	 * ~~~
	 * function ($index, $label, $name, $checked, $value)
	 * ~~~
	 *
	 * where $index is the zero-based index of the radio button in the whole list; $label
	 * is the label for the radio button; and $name, $value and $checked represent the name,
	 * value and the checked status of the radio button input.
	 * @return static the field object itself
	 */
	public function radioList($items, $options = [])
	{
		$this->adjustLabelFor($options);
		
		$this->listOptions = array_merge($this->listOptions, $options);
		$this->input_options = ['type' => 'activeRadioList', 'items' => $items];
	
		return $this;
	}
	
	/**
	 * Draw Button Options
	 * @param array $options
	 * @return array
	 */
	protected function drawButtonOptions($options = [])
	{
		$type = isset($options['type']) ? ArrayHelper::remove($options, 'type') : 'default';
		
		$options = ArrayHelper::merge(['itemOptions' => ['class' => 'hidden', 'container' => ['isCheckedOptions' => ['class' => 'active']]]], $options);
		
		Html::addCssClass($options['itemOptions']['container'], 'btn btn-' . $type);
		
		if ($this->_isButtonVertical)
			Html::addCssClass($options, 'btn-group-vertical');
		else
			Html::addCssClass($options, 'btn-group');
		
		$options['data-toggle'] = 'buttons';
		
		if (isset($options['size']))
			Html::addCssClass($options['itemOptions']['container'], 'btn-' . ArrayHelper::remove($options, 'size'));
		
		return $options;
	}

	
	
	
	/**
	 * ==============================================================================================================
	 * Begin The HTML 5 Input type
	 * ==============================================================================================================
	 */
	
	/**
	 * Base Renders html5 input
	 * @param string $type
	 * @param array $options
	 * @return ActiveField
	 */
	protected function html5input($type, $options = [])
	{
		$this->inputOptions = array_merge($this->inputOptions, $options);
		$this->adjustLabelFor($this->inputOptions);
		$this->input_options = ['type' => $type, 'inputOnly' => true];
		
		return $this;
	}
	
	/**
	 * Renders a email input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function emailInput($options = [])
	{
		return $this->html5input('email', $options);
	}
	
	/**
	 * Renders a date input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function dateInput($options = [])
	{
		return $this->html5input('date', $options);
	}
	
	/**
	 * Renders a datetime input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function datetimeInput($options = [])
	{
		return $this->html5input('datetime', $options);
	}
	
	/**
	 * Renders a datetime local input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function datetimeLocalInput($options = [])
	{
		return $this->html5input('datetime-local', $options);
	}
	
	/**
	 * Renders a time input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function timeInput($options = [])
	{
		return $this->html5input('time', $options);
	}
	
	/**
	 * Renders a url input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function urlInput($options = [])
	{
		return $this->html5input('url', $options);
	}
	
	/**
	 * Renders a color input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function colorInput($options = [])
	{
		return $this->html5input('color', $options);
	}
	
	/**
	 * Renders a number input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function numberInput($options = [])
	{
		return $this->html5input('number', $options);
	}
	
	/**
	 * Renders a month input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function monthInput($options = [])
	{
		return $this->html5input('month', $options);
	}
	
	
	
	/**
	 * Renders a range input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function rangeInput($options = [])
	{
		return $this->html5input('range', $options);
	}
	
	/**
	 * Renders a telepon input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function telInput($options = [])
	{
		return $this->html5input('tel', $options);
	}
	
	/**
	 * Renders a search input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function searchInput($options = [])
	{
		return $this->html5input('search', $options);
	}
	
	/**
	 * Renders a week input.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function weekInput($options = [])
	{
		return $this->html5input('week', $options);
	}
	
	/**
	 * Renders a image input type.
	 * This method will generate the "name" and "value" tag attributes automatically for the model attribute
	 * unless they are explicitly specified in `$options`.
	 * @param array $options the tag options in terms of name-value pairs. These will be rendered as
	 * the attributes of the resulting tag. The values will be HTML-encoded using [[Html::encode()]].
	 * @return static the field object itself
	 */
	public function imageInput($options = [])
	{
		$options['src'] = Html::getAttributeValue($this->model, $this->attribute);
		return $this->html5input('image', $options);
	}
	
	/**
	 * ==============================================================================================================
	 * End of The HTML 5 Input type
	 * ==============================================================================================================
	 */
	
	/**
	 * ==============================================================================================================
	 * New Input Options from here
	 * ==============================================================================================================
	 */
	
	/**
	 * Prepend is a Bootstrap feature input group addon.
	 * Extend form controls by adding text or buttons before sides of any text-based input.
	 * To use this options, follow code below :
	 * ~~~
	 * ```php
	 * <?php
	 * // for text only
	 * $form->field($model, 'attribute')->prepend('Prepend Text');
	 * 
	 * // Prepend for Button, ButtonDropdown, ButtonGroup, ButtonLoading.
	 * $form->field($model, 'attribute')->prepend(ClassName, $buttonConfig);
	 * 
	 * // Button
	 * $form->field($model, 'attribute')->prepend(Button::className(), ['label' => 'Button']);
	 * 
	 * // ButtonDropdown
	 * $form->field($model, 'attribute')->prepend(ButtonDropdown::className(), [
	 *     'label' => 'Dropdown', 
	 *     'items' => [
	 *         ['label' => 'Index', 'url' => ['index']],
	 *         ['label' => 'About', 'url' => ['about']],
	 *         ['label' => 'Help', 'url' => ['help']],
	 *     ],
	 * ]);
	 * 
	 * // ButtonGroup
	 * $form->field($model, 'attribute')->prepend(ButtonGroup::className(), [
	 *     'buttons' => [
	 *         Button::widget(['label' => 'Index', 'url' => ['index']]),
	 *         Button::widget(['label' => 'About', 'url' => ['about']]),
	 *     ],
	 * ]);
	 * 
	 * // ButtonLoading
	 * $form->field($model, 'attribute')->prepend(ButtonLoading::className(), [
	 *     'loadingText' => 'Button is loading . . .',
	 *     'completeText' => 'Button is complete loading . . .',
	 *     'loadingTimeout' => 5, //second
	 *     'completeTimeout' => 2, //second
	 * ]);
	 * ```
	 * ~~~
	 * @param mixed $content
	 * @param array $options
	 */
	public function prepend($content, $options = [], $asButton = false)
	{
		if (!$this->hasapprepend) {
			$optionsTag = ['class' => 'input-group'];
			if (isset($this->_size))
				Html::addCssClass($optionsTag, 'input-group-' . $this->_size);
			$this->template = \Yii::t('yii', $this->template, ['input' => Html::tag('div', '{input}', $optionsTag)]);
			$this->hasapprepend = true;
		}
		
		$parts = $this->generateAddon($content, $options);
 		
		$this->template = \Yii::t('yii', $this->template, ['input' => $parts . '{input}']);
		
		return $this;
	}
	
	/**
	 * Append is a Bootstrap feature input group addon.
	 * Extend form controls by adding text or buttons after sides of any text-based input.
	 * To use this options, follow code below :
	 * ~~~
	 * ```php
	 * <?php
	 * // for text only
	 * $form->field($model, 'attribute')->append('Append Text');
	 * 
	 * // Append for Button, ButtonDropdown, ButtonGroup, ButtonLoading.
	 * $form->field($model, 'attribute')->append(ClassName, $buttonConfig);
	 * 
	 * // Button
	 * $form->field($model, 'attribute')->append(Button::className(), ['label' => 'Button']);
	 * 
	 * // ButtonDropdown
	 * $form->field($model, 'attribute')->append(ButtonDropdown::className(), [
	 *     'label' => 'Dropdown', 
	 *     'items' => [
	 *         ['label' => 'Index', 'url' => ['index']],
	 *         ['label' => 'About', 'url' => ['about']],
	 *         ['label' => 'Help', 'url' => ['help']],
	 *     ],
	 * ]);
	 * 
	 * // ButtonGroup
	 * $form->field($model, 'attribute')->append(ButtonGroup::className(), [
	 *     'buttons' => [
	 *         Button::widget(['label' => 'Index', 'url' => ['index']]),
	 *         Button::widget(['label' => 'About', 'url' => ['about']]),
	 *     ],
	 * ]);
	 * 
	 * // ButtonLoading
	 * $form->field($model, 'attribute')->append(ButtonLoading::className(), [
	 *     'loadingText' => 'Button is loading . . .',
	 *     'completeText' => 'Button is complete loading . . .',
	 *     'loadingTimeout' => 5, //second
	 *     'completeTimeout' => 2, //second
	 * ]);
	 * ```
	 * ~~~
	 * @param mixed $content
	 * @param array $options
	 */
	public function append($content, $options = [], $asButton = false)
	{
		if (!$this->hasapprepend) {
			$optionsTag = ['class' => 'input-group'];
			if (isset($this->_size))
				Html::addCssClass($optionsTag, 'input-group-' . $this->_size);
			$this->template = \Yii::t('yii', $this->template, ['input' => Html::tag('div', '{input}', $optionsTag)]);
			$this->hasapprepend = true;
		}
		
		$parts = $this->generateAddon($content, $options, $asButton);
		
		$this->template = \Yii::t('yii', $this->template, ['input' => '{input}' . $parts]);
		
		return $this;
	}
	
	/**
	 * Generate addon for append or prepend.
	 * @param Object $content
	 * @param array $options
	 * @return string
	 */
	protected function generateAddon($content, $options = [], $asButton = false)
	{
		if ($content === ButtonDropdown::className()) {
			Html::addCssClass($options['optionGroups'], 'input-group-btn');
			$parts = $content::widget($options);
		} elseif (($content === Button::className()) || ($content === ButtonLoading::className())) {
			$optionsTag = ['class' => 'input-group-btn'];
			$parts = Html::tag('div', $content::widget($options), $optionsTag);
		} elseif ($content === ButtonGroup::className()) {
			$options['hasInputGroup'] = true;
			$parts = $content::widget($options);
		} else {
			if ($asButton)
				Html::addCssClass($options, 'input-group-btn');
			else
				Html::addCssClass($options, 'input-group-addon');
			$parts = Html::tag('span', $content, $options);
		}
		return $parts;
	}
	
	/**
	 * Size type is a bootstrap feature input option.
	 * @param string $value is a size type valid value are 'sm', and 'lg'.
	 * type detail:
	 * sm = Small.
	 * lg = Large.
	 * @return Object
	 */
	public function size($value)
	{
		if (in_array($value, ['sm', 'lg'])) {
			$this->_size = $value;
			Html::addCssClass($this->inputOptions, 'input-' . $value);
		}
		return $this;
	}
	
	/**
	 * Column Wrapper form control is a bootstrap grid system.
	 * ~~~
	 * Example in array mode:
	 * ```php
	 * 
	 * <?php
	 * $form->field($model, 'attribute')->wrap([
	 * 		'label' => 'col-sm-3', 
	 * 		'input' => 'col-sm-6',
	 * ]);
	 * 
	 * ```
	 * 
	 * Example in string mode:
	 * ```php
	 * 
	 * <?php
	 * // please look this wrap('label&input') for use the string mode
	 * // Use for label and input
	 * $form->field($model, 'attribute')->wrap('col-sm-3&col-sm-6');
	 * 
	 * // Use for label only
	 * $form->field($model, 'attribute')->wrap('col-sm-3&');
	 * 
	 * // Use for input only
	 * $form->field($model, 'attribute')->wrap('&col-sm-6');
	 * 
	 * ```
	 * ~~~
	 * Value for `label` or `input`. see below.
	 * - col-xs-*.
	 * - col-sm-*.
	 * - col-md-*.
	 * - col-lg-*.
	 * @param string|array $options column wrapper valid option value are `label` and `input`.
	 */
	public function wrap($options)
	{
		if (is_array($options)) {
			foreach ($options as $key => $value)
			{
				$property = '_wrap_' . $key;
				$this->$property = $value;
			}
		} elseif (is_string($options)) {
			list($label, $input) = split('&', $options);
			
			if ($label != null)
				$this->_wrap_label = $label;
			
			if ($input != null)
				$this->_wrap_input = $input;
		}
		return $this;
	}
	
	/**
	 * Hidden the Label field.
	 */
	public function hiddenLabel()
	{
		Html::addCssClass($this->labelOptions, 'hidden');
		return $this;
	}
	
	/**
	 * Hidden the error field.
	 */
	public function hiddenError()
	{
		Html::addCssClass($this->errorOptions, 'hidden');
		return $this;
	}
	
	/**
	 * Set the Field Label to placeholder.
	 * to generate a placeholder from label.
	 */
	public function labelToPlaceholder()
	{
		if (!isset($this->inputOptions['placeholder']))
			$this->placeholder($this->model->getAttributeLabel($this->attribute));
		
		return $this;
	}
	
	/**
	 * placeholder.
	 * specifies a short hint that describes the expected valie of an `<input>` and `<textarea>` element.
	 * 
	 * @param string $value
	 */
	public function placeholder($value)
	{
		if (!is_string($value))
			throw new InvalidParamException();
			
		$this->inputOptions['placeholder'] = $value;
		
		return $this;
	}
	
	public $noGroup = false;
	
	/**
	 * noGroup
	 * is a function to remove form-group.
	 */
	public function noGroup()
	{
		$this->noGroup = true;
		return $this;
	}
	
	/**
	 * hidden
	 * is a function to hide form-group
	 */
	public function hidden()
	{
		Html::addCssClass($this->options, 'hidden');
		return $this;
	}
	
	/**
	 * Generates a label tag for [[attribute]].
	 * @param string $label the label to use. If null, it will be generated via [[Model::getAttributeLabel()]].
	 * Note that this will NOT be [[Html::encode()|encoded]].
	 * @param array $options the tag options in terms of name-value pairs. It will be merged with [[labelOptions]].
	 * The options will be rendered as the attributes of the resulting tag. The values will be HTML-encoded
	 * using [[Html::encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * @return static the field object itself
	 */
	public function label($label = null, $options = [])
	{
		$this->labelOptions = array_merge($this->labelOptions, $options);
		if ($label !== null) {
			if (is_bool($label)) {
				if ($label == false) {
					$this->parts['{label}'] = '';
				}
			} else {
				$this->labelOptions['label'] = $label;
			}
		}
	
		return $this;
	}
	
	
	/**
	 * readOnly
	 * specifies that an input field is read-only
	 * Use this to readonly for `input`, `textarea`, or `dropdownlist` and `listbox`.
	 * @return ActiveField
	 */
	public function readOnly()
	{
		$this->inputOptions['readonly'] = 'readonly';
		return $this;
	}
	
	/**
	 * disabled
	 * specifies that and <input> element should be disabled.
	 * Use this to disable `input`, `textarea`, or `dropdownlist` and `listbox`.
	 * @return ActiveField
	 */
	public function disabled()
	{
		$this->inputOptions['disabled'] = 'disabled';
		return $this;
	}
	
	/**
	 * Multiple
	 * specifies that a user can enter more than one value in an <input> element
	 * use this for listbox is a for multiple selection
	 * @return ActiveField
	 */
	public function multiple()
	{
		$this->inputOptions['multiple'] = 'multiple';
		return $this;
	}
	
	/**
	 * checked.
	 * specifies that an <input> element should be pre-selected when the page loads for `checkbox` or `radio`.
	 * @return ActiveField
	 */
	public function checked()
	{
		$this->inputOptions['checked'] = 'checked';
		
		return $this;
	}
	
	/**
	 * autofocus.
	 * specifies than an `input` element should automatically get focus when the page loads.
	 * @return ActiveField
	 */
	public function autofocus()
	{
		$this->inputOptions['autofocus'] = 'autofocus';
		
		return $this;
	}
	
	/**
	 * autocomplete
	 * specfies whether an `input` element should have autocomplete enabled.
	 * @param boolean $bool to enable or disable autocomplete
	 * @return ActiveField
	 */
	public function autocomplete($bool)
	{
		$options = [true => 'on', false => 'off'];
		$this->inputOptions['autocomplete'] = $options[$bool];
		
		return $this;
	}
	
	/**
	 * accept.
	 * specifies the types of files that the server accepts only for `fileInput()`.
	 * more value
	 * ~~~
	 * audio/*
	 * video/*
	 * image/*
	 * MIME_type
	 * ~~~
	 * @param string $value
	 */
	public function accept($value)
	{
		$this->inputOptions['accept'] = $value;
		
		return $this;
	}
	
	/**
	 * alt is an alternative text.
	 * specifies an alternative text for `imageInput()`.
	 * @param string $value alternative text
	 * @return ActiveField
	 */
	public function alt($value)
	{
		$this->inputOptions['alt'] = $value;
		
		return $this;
	}
	
	/**
	 * width
	 * specifies the width of an `input` element only for `imageInput()`
	 * @param string|integer $value
	 * @return ActiveField
	 */
	public function width($value)
	{
		$this->inputOptions['width'] = $value;
		
		return $this;
	}
	
	/**
	 * height
	 * specifies the height of an `input` element only for `imageInput()`
	 * @param string|integer $value
	 * @return ActiveField
	 */
	public function height($value)
	{
		$this->inputOptions['height'] = $value;
	
		return $this;
	}
	
	/**
	 * max.
	 * specifies the maximum value for `input` element.
	 * @param integer|string $value valid value are number or date
	 * @return ActiveField
	 */
	public function max($value)
	{
		$this->inputOptions['max'] = $value;
		
		return $this;
	}
	
	/**
	 * min.
	 * specifies the minimum value for `input` element.
	 * @param integer|string $value valid value are number or date
	 * @return ActiveField
	 */
	public function min($value)
	{
		$this->inputOptions['min'] = $value;
	
		return $this;
	}
	
	/**
	 * Length input options.
	 * use this to set input length with max or min.
	 * Length is a default attribute option from html input element (maxlength and minlength). 
	 * use this to set input length with max or min. 
	 * `max` specifies the maximum number of characters allowed an `input` or `textarea` element.
	 * `min` specifies the minimum number of characters allowed an `input` or `textarea` element.
	 * valid value are number or date.
	 * In string mode have two operator prefix. 
	 * operator minus `-` is a option for `minlength`.
	 * operator plus `+` is a options for `maxlength`.
	 * for example code:
	 * ```
	 * #!php
	 * 
	 * <?php
	 * 
	 * // in array mode
	 * $form->field($model, 'input')->length([
	 * 		'max' => '255',
	 * 		'min' => '10',
	 * ]);
	 * 
	 * // in string mode
	 * $form->field($model, 'input')->length('-10&+255');
	 * 
	 * ```
	 * ~~~
	 * @param array|string $value
	 */
	public function length($value)
	{
		$optDefault = ['-', '+'];
		$optNameDefault = ['-' => 'minlength', '+' => 'maxlength'];
		
		if (is_array($value))
		{
			if (isset($value['max']))
				$this->inputOptions['maxlength'] = $value['max'];
			if (isset($value['min']))
				$this->inputOptions['minlength'] = $value['min'];
		}
		
		if (is_string($value))
		{
			$values = split('&', $value);
			
			foreach ($values as $val)
			{
				$opt = substr($val, 0, 1);
				$int = substr($val, strpos($val, $opt) + 1);
				if (in_array($opt, $optDefault))
					$this->inputOptions[$optNameDefault[$opt]] = $int;
			}
		}
		
		return $this;
	}
	
	/**
	 * pattern.
	 * specifies a regular expression that an `input` element's value is checked against
	 * @param string $pattern regexp
	 * @throws InvalidParamException
	 * @return ActiveField
	 */
	public function pattern($pattern)
	{
		if (!is_string($pattern))
			throw new InvalidParamException();
		
		$this->inputOptions['pattern'] = $pattern;
		
		return $this;
	}
	
	/**
	 * step.
	 * specifies the legal number intervals for an input field. 
	 * @param integer $value
	 * @throws InvalidParamException
	 */
	public function step($value)
	{
		if (!is_integer($value))
			throw new InvalidParamException();
		
		$this->inputOptions['step'] = $value;
	}
	
	/**
	 * Set The input to inline.
	 * Use inline on a series of checkbox list and radio list for controls that appear on the same line.
	 * Specifies the inline input only for `radioList` and `checkboxList` to set the inline list.
	 * ~~~
	 * ```php
	 * <?php
	 * $form->field($model, 'attribute')->checkboxList([
	 *        'first' => 'First List',
	 *        'second' => 'Second List',
	 *        'Third' => 'Third List'
	 * ])->inline();
	 * 
	 * $form->field($model, 'attribute')->radioList([
	 *        'first' => 'First List',
	 *        'second' => 'Second List',
	 *        'Third' => 'Third List'
	 * ])->inline();
	 * ```
	 * ~~~
	 * @return ActiveField
	 */
	public function inline()
	{
		if (!$this->_inline)
			$this->_inline = true;
		
		return $this;
	}
	
	/**
	 * Set the input to bootstrap button toggle.
	 * Specifies the button input only for `radioList` and `checkboxList` to set the Radio Button Toggle or Checkbox Button Toggle.
	 * ~~~
	 * ```php
	 * <?php
	 * $form->field($model, 'attribute')->checkboxList([
	 *        'first' => 'First List',
	 *        'second' => 'Second List',
	 *        'Third' => 'Third List'
	 * ])->button();
	 * 
	 * $form->field($model, 'attribute')->radioList([
	 *        'first' => 'First List',
	 *        'second' => 'Second List',
	 *        'Third' => 'Third List'
	 * ])->button();
	 * ```
	 * ~~~
	 * @return ActiveField
	 */
	public function button()
	{
		if (!$this->_isButton)
			$this->_isButton = true;
		return $this;
	}
	
	/**
	 * Set the input to bootstrap button toggle vertical mode.
	 * Specifies the button input only for `radioList` and `checkboxList` to set the Radio Button Toggle or Checkbox Button Toggle.
	 * ~~~
	 * ```php
	 * <?php
	 * $form->field($model, 'attribute')->checkboxList([
	 *        'first' => 'First List',
	 *        'second' => 'Second List',
	 *        'Third' => 'Third List'
	 * ])->buttonVertical();
	 * 
	 * $form->field($model, 'attribute')->radioList([
	 *        'first' => 'First List',
	 *        'second' => 'Second List',
	 *        'Third' => 'Third List'
	 * ])->buttonVertical();
	 * ```
	 * ~~~
	 * @return ActiveField
	 */
	public function buttonVertical()
	{
		if (!$this->_isButtonVertical)
			$this->_isButtonVertical = true;
		return $this;
	}
	
	/**
	 * Template Changer
	 * this is function to custom template.
	 * --------------------------------------------------------------
	 *
	 * ```
	 * #!php
	 *
	 * <?php
	 *
	 * $form->field($model, 'attribute')->template('{label} {input} {error} {hint}'); //in string mode
	 *
	 * $form->field($model, 'attribute')->template(['{input}' => '<div class="well">{input}</div>']); //in array mode
	 *
	 * ```
	 *
	 * --------------------------------------------------------------
	 * @param mixed $template is a string template or array template
	 */
	public function template($template)
	{
		if (is_string($template))
			$this->template = $template;
	
		if (is_array($template))
		{
			foreach ($template as $key => $value)
			{
				$this->template = str_replace($key, $value, $this->template);
			}
		}
	
		return $this;
	}
	
	/**
	 * =================================================================================
	 * end new input options
	 * =================================================================================
	 */
	
	/**
	 * (non-PHPdoc)
	 * @see \yii\widgets\ActiveField::widget()
	 */
	public function widget($class, $config = [])
	{
		$classOptions = ArrayHelper::remove($this->inputOptions, 'class', '');
		$config = ArrayHelper::merge($this->inputOptions, $config);
		Html::addCssClass($config['options'], $classOptions);
		
		return parent::widget($class, $config);
	}

	/**
	 * setting up the label to support bootstrap label
	 */
	protected function setupLabel()
	{
		if ($this->formType == self::HORIZONTAL) {
			Html::addCssClass($this->labelOptions, $this->_wrap_label);
			if ($this->leftLabel == true)
				$this->labelOptions['style'] = 'text-align: left;';
		}
		
		if ($this->formType == self::INLINE) {
			$this->parts['{label}'] = '';
			$this->labelToPlaceholder();
		}
		
		if (isset($this->labelOptions['hidden']) && $this->labelOptions['hidden']) {
			$this->parts['{label}'] = '';
		}
	}
	
	/**
	 * setting up the template to support bootstrap template
	 */
	protected function setupTemplateForm()
	{
		// setup template form
		if ($this->formType == self::HORIZONTAL) {
			$this->template = '{label}<div class="' . $this->_wrap_input . '">{input} {error}</div> {hint}';
		}
	}
	
	/**
	 * Renders the whole field.
	 * This method will generate the label, error tag, input tag and hint tag (if any), and
	 * assemble them into HTML according to [[template]].
	 * @param string|callable $content the content within the field container.
	 * If null (not set), the default methods will be called to generate the label, error tag and input tag,
	 * and use them as the content.
	 * If a callable, it will be called to generate the content. The signature of the callable should be:
	 *
	 * ~~~
	 * function ($field) {
	 *     return $html;
	 * }
	 * ~~~
	 *
	 * @return string the rendering result
	 */
	public function render($content = null)
	{
		//setting up label
		$this->setupLabel();
		//setting up template form
		$this->setupTemplateForm();
		
		if ($content === null) {
			
			if (!isset($this->parts['{input}'])) {
				
				extract($this->input_options);
				
				if (in_array($type, $this->inputTypes)) {
					$this->parts['{input}'] = Html::$type($this->model, $this->attribute, $this->inputOptions);
				}
				
				elseif (in_array($type, $this->inputListTypes)) {
					$options = $this->listOptions;
					
					if ($this->_inline) {
						
						if ($type == "activeCheckboxList")
							Html::addCssClass($options['itemOptions']['container'], 'checkbox-inline');
						
						if ($type == "activeRadioList")
							Html::addCssClass($options['itemOptions']['container'], 'radio-inline');

						if (!$this->_isButton)
							Html::addCssStyle($options['itemOptions']['container'], 'margin-left:0;margin-right:10px;');
					}
					
					if (isset($this->_size))
						$options['size'] = $this->_size;
					
					if ($this->_isButtonVertical)
						$options = $this->drawButtonOptions($options);
					elseif ($this->_isButton)
						$options = $this->drawButtonOptions($options);
										
					$this->parts['{input}'] = Html::$type($this->model, $this->attribute, $items, $options);
				}
				
				elseif (in_array($type, $this->inputDropdownTypes)) {
					$this->parts['{input}'] = Html::$type($this->model, $this->attribute, $items, $this->inputOptions);
				}
				
				elseif (isset($inputOnly) and $inputOnly == true) {
					$this->parts['{input}'] = Html::activeInput($type, $this->model, $this->attribute, $this->inputOptions);
				}
				
				elseif (isset($onlyOne) and $onlyOne == true) {
					$this->parts['{input}'] = Html::$type($this->model, $this->attribute, $this->listOptions);
				}
			}
			if (!isset($this->parts['{label}'])) {
				$this->parts['{label}'] = Html::activeLabel($this->model, $this->attribute, $this->labelOptions);
			}
			if (!isset($this->parts['{error}'])) {
				$this->parts['{error}'] = Html::error($this->model, $this->attribute, $this->errorOptions);
			}
			if (!isset($this->parts['{hint}'])) {
				$this->parts['{hint}'] = '';
			}
			$content = strtr($this->template, $this->parts);
		} elseif (!is_string($content)) {
			$content = call_user_func($content, $this);
		}
	
		return $this->begin() . "\n" . $content . "\n" . $this->end();
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \yii\widgets\ActiveField::begin()
	 */
	public function begin()
	{
		if ($this->noGroup) {
			$clientOptions = $this->getClientOptions();
			if (!empty($clientOptions)) {
				$this->form->attributes[$this->attribute] = $clientOptions;
			}
			
			$inputID = Html::getInputId($this->model, $this->attribute);
			$attribute = Html::getAttributeName($this->attribute);
			$options = $this->options;
			$class = isset($options['class']) ? [$options['class']] : [];
			$class[] = "field-$inputID";
			if ($this->model->isAttributeRequired($attribute)) {
				$class[] = $this->form->requiredCssClass;
			}
			if ($this->model->hasErrors($attribute)) {
				$class[] = $this->form->errorCssClass;
			}
			$options['class'] = implode(' ', $class);
		} else {
			return parent::begin();
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \yii\widgets\ActiveField::end()
	 */
	public function end()
	{
		if (!$this->noGroup) {
			return parent::end();
		}
	}
}
