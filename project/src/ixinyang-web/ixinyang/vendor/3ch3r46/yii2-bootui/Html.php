<?php
namespace bootui;
use yii\helpers\ArrayHelper;
class Html extends \yii\helpers\BaseHtml
{
	/**
	 * Generates a list of checkboxes.
	 * A checkbox list allows multiple selection, like [[listBox()]].
	 * As a result, the corresponding submitted value is an array.
	 * @param string $name the name attribute of each checkbox.
	 * @param string|array $selection the selected value(s).
	 * @param array $items the data item used to generate the checkboxes.
	 * The array values are the labels, while the array keys are the corresponding checkbox values.
	 * @param array $options options (name => config) for the checkbox list container tag.
	 * The following options are specially handled:
	 *
	 * - tag: string, the tag name of the container element.
	 * - unselect: string, the value that should be submitted when none of the checkboxes is selected.
	 *   By setting this option, a hidden input will be generated.
	 * - encode: boolean, whether to HTML-encode the checkbox labels. Defaults to true.
	 *   This option is ignored if `item` option is set.
	 * - separator: string, the HTML code that separates items.
	 * - itemOptions: array, the options for generating the radio button tag using [[checkbox()]].
	 * - item: callable, a callback that can be used to customize the generation of the HTML code
	 *   corresponding to a single item in $items. The signature of this callback must be:
	 *
	 *   ~~~
	 *   function ($index, $label, $name, $checked, $value)
	 *   ~~~
	 *
	 *   where $index is the zero-based index of the checkbox in the whole list; $label
	 *   is the label for the checkbox; and $name, $value and $checked represent the name,
	 *   value and the checked status of the checkbox input, respectively.
	 *
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * @return string the generated checkbox list
	 */
	public static function checkboxList($name, $selection = null, $items = [], $options = [])
	{
		if (substr($name, -2) !== '[]') {
			$name .= '[]';
		}
	
		$formatter = isset($options['item']) ? $options['item'] : null;
		$itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];
		$checkedOptions = isset($itemOptions['isCheckedOptions']) ? $itemOptions['isCheckedOptions'] : [];
		$encode = !isset($options['encode']) || $options['encode'];
		$lines = [];
		$index = 0;
		foreach ($items as $value => $label) {
			$checked = $selection !== null &&
			(!is_array($selection) && !strcmp($value, $selection)
					|| is_array($selection) && in_array($value, $selection));
			if ($formatter !== null) {
				$lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
			} else {
				$lines[] = static::checkbox($name, $checked, array_merge($itemOptions, [
						'value' => $value,
						'label' => $encode ? static::encode($label) : $label,
						]));
			}
			$index++;
		}
	
		if (isset($options['unselect'])) {
			// add a hidden field so that if the list box has no option being selected, it still submits a value
			$name2 = substr($name, -2) === '[]' ? substr($name, 0, -2) : $name;
			$hidden = static::hiddenInput($name2, $options['unselect']);
		} else {
			$hidden = '';
		}
		$separator = isset($options['separator']) ? $options['separator'] : "\n";
	
		$tag = isset($options['tag']) ? $options['tag'] : 'div';
		unset($options['tag'], $options['unselect'], $options['encode'], $options['separator'], $options['item'], $options['itemOptions']);
	
		return $hidden . static::tag($tag, implode($separator, $lines), $options);
	}
	
	/**
	 * Generates a list of radio buttons.
	 * A radio button list is like a checkbox list, except that it only allows single selection.
	 * @param string $name the name attribute of each radio button.
	 * @param string|array $selection the selected value(s).
	 * @param array $items the data item used to generate the radio buttons.
	 * The array values are the labels, while the array keys are the corresponding radio button values.
	 * @param array $options options (name => config) for the radio button list. The following options are supported:
	 *
	 * - unselect: string, the value that should be submitted when none of the radio buttons is selected.
	 *   By setting this option, a hidden input will be generated.
	 * - encode: boolean, whether to HTML-encode the checkbox labels. Defaults to true.
	 *   This option is ignored if `item` option is set.
	 * - separator: string, the HTML code that separates items.
	 * - itemOptions: array, the options for generating the radio button tag using [[radio()]].
	 * - item: callable, a callback that can be used to customize the generation of the HTML code
	 *   corresponding to a single item in $items. The signature of this callback must be:
	 *
	 *   ~~~
	 *   function ($index, $label, $name, $checked, $value)
	 *   ~~~
	 *
	 *   where $index is the zero-based index of the radio button in the whole list; $label
	 *   is the label for the radio button; and $name, $value and $checked represent the name,
	 *   value and the checked status of the radio button input, respectively.
	 *
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * @return string the generated radio button list
	 */
	public static function radioList($name, $selection = null, $items = [], $options = [])
	{
		$encode = !isset($options['encode']) || $options['encode'];
		$formatter = isset($options['item']) ? $options['item'] : null;
		$itemOptions = isset($options['itemOptions']) ? $options['itemOptions'] : [];
		$lines = [];
		$index = 0;
		foreach ($items as $value => $label) {
			$checked = $selection !== null &&
			(!is_array($selection) && !strcmp($value, $selection)
					|| is_array($selection) && in_array($value, $selection));
			if ($formatter !== null) {
				$lines[] = call_user_func($formatter, $index, $label, $name, $checked, $value);
			} else {
				$lines[] = static::radio($name, $checked, array_merge($itemOptions, [
						'value' => $value,
						'label' => $encode ? static::encode($label) : $label,
						]));
			}
			$index++;
		}
	
		$separator = isset($options['separator']) ? $options['separator'] : "\n";
		if (isset($options['unselect'])) {
			// add a hidden field so that if the list box has no option being selected, it still submits a value
			$hidden = static::hiddenInput($name, $options['unselect']);
		} else {
			$hidden = '';
		}
	
		$tag = isset($options['tag']) ? $options['tag'] : 'div';
		unset($options['tag'], $options['unselect'], $options['encode'], $options['separator'], $options['item'], $options['itemOptions']);
	
		return $hidden . static::tag($tag, implode($separator, $lines), $options);
	}
	
	/**
	 * Generates a radio button input.
	 * @param string $name the name attribute.
	 * @param boolean $checked whether the radio button should be checked.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the radio button. When this attribute
	 *   is present, a hidden input will be generated so that if the radio button is not checked and is submitted,
	 *   the value of this attribute will still be submitted to the server via the hidden input.
	 * - label: string, a label displayed next to the radio button.  It will NOT be HTML-encoded. Therefore you can pass
	 *   in HTML code such as an image tag. If this is is coming from end users, you should [[encode()]] it to prevent XSS attacks.
	 *   When this option is specified, the radio button will be enclosed by a label tag.
	 * - labelOptions: array, the HTML attributes for the label tag. This is only used when the "label" option is specified.
	 * - container: array|boolean, the HTML attributes for the container tag. This is only used when the "label" option is specified.
	 *   If it is false, no container will be rendered. If it is an array or not, a "div" container will be rendered
	 *   around the the radio button.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting radio button tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * @return string the generated radio button tag
	 */
	public static function radio($name, $checked = false, $options = [])
	{
		$options['checked'] = (boolean) $checked;
		$value = array_key_exists('value', $options) ? $options['value'] : '1';
		if (isset($options['uncheck'])) {
			// add a hidden field so that if the radio button is not selected, it still submits a value
			$hidden = static::hiddenInput($name, $options['uncheck']);
			unset($options['uncheck']);
		} else {
			$hidden = '';
		}
		if (isset($options['label'])) {
			$label = $options['label'];
			$labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
			$container = isset($options['container']) ? $options['container'] : ['class' => 'radio'];
			$checkedOptions = isset($container['isCheckedOptions']) ? ArrayHelper::remove($container,'isCheckedOptions') : [];
			if ($checked) {
				if (isset($checkedOptions['class']))
					static::addCssClass($container, ArrayHelper::remove($checkedOptions, 'class'));
				$container = ArrayHelper::merge($container, $checkedOptions);
			}
			unset($options['label'], $options['labelOptions'], $options['container']);
			$content = static::label(static::input('radio', $name, $value, $options) . ' ' . $label, null, $labelOptions);
			if (is_array($container)) {
				return $hidden . static::tag('div', $content, $container);
			} else {
				return $hidden . $content;
			}
		} else {
			return $hidden . static::input('radio', $name, $value, $options);
		}
	}
	
	/**
	 * Generates a checkbox input.
	 * @param string $name the name attribute.
	 * @param boolean $checked whether the checkbox should be checked.
	 * @param array $options the tag options in terms of name-value pairs. The following options are specially handled:
	 *
	 * - uncheck: string, the value associated with the uncheck state of the checkbox. When this attribute
	 *   is present, a hidden input will be generated so that if the checkbox is not checked and is submitted,
	 *   the value of this attribute will still be submitted to the server via the hidden input.
	 * - label: string, a label displayed next to the checkbox.  It will NOT be HTML-encoded. Therefore you can pass
	 *   in HTML code such as an image tag. If this is is coming from end users, you should [[encode()]] it to prevent XSS attacks.
	 *   When this option is specified, the checkbox will be enclosed by a label tag.
	 * - labelOptions: array, the HTML attributes for the label tag. This is only used when the "label" option is specified.
	 * - container: array|boolean, the HTML attributes for the container tag. This is only used when the "label" option is specified.
	 *   If it is false, no container will be rendered. If it is an array or not, a "div" container will be rendered
	 *   around the the radio button.
	 *
	 * The rest of the options will be rendered as the attributes of the resulting checkbox tag. The values will
	 * be HTML-encoded using [[encode()]]. If a value is null, the corresponding attribute will not be rendered.
	 * See [[renderTagAttributes()]] for details on how attributes are being rendered.
	 *
	 * @return string the generated checkbox tag
	 */
	public static function checkbox($name, $checked = false, $options = [])
	{
		$options['checked'] = (boolean) $checked;
		$value = array_key_exists('value', $options) ? $options['value'] : '1';
		if (isset($options['uncheck'])) {
			// add a hidden field so that if the checkbox is not selected, it still submits a value
			$hidden = static::hiddenInput($name, $options['uncheck']);
			unset($options['uncheck']);
		} else {
			$hidden = '';
		}
		if (isset($options['label'])) {
			$label = $options['label'];
			$labelOptions = isset($options['labelOptions']) ? $options['labelOptions'] : [];
			$container = isset($options['container']) ? $options['container'] : ['class' => 'checkbox'];
			$checkedOptions = isset($container['isCheckedOptions']) ? ArrayHelper::remove($container,'isCheckedOptions') : [];
			if ($checked) {
				if (isset($checkedOptions['class']))
					static::addCssClass($container, ArrayHelper::remove($checkedOptions, 'class'));
				$container = ArrayHelper::merge($container, $checkedOptions);
			}unset($options['label'], $options['labelOptions'], $options['container']);
			$content = static::label(static::input('checkbox', $name, $value, $options) . ' ' . $label, null, $labelOptions);
			if (is_array($container)) {
				return $hidden . static::tag('div', $content, $container);
			} else {
				return $hidden . $content;
			}
		} else {
			return $hidden . static::input('checkbox', $name, $value, $options);
		}
	}
}