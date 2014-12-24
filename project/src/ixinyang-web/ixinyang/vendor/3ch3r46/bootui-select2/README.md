3ch3r46/bootui-select2
===================
Select2 is a jQuery based replacement for select boxes. It supports searching, remote data sets, and infinite scrolling of results.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist 3ch3r46/bootui-select2 "*"
```

or add

```
"3ch3r46/bootui-select2": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```
<?php
echo Select2::widget([
	'name' => 'selection-name', 
	'value' => 'first',
	'items' => ['first' => 'First Option', 'second' => 'Second Option', 'third' => 'Third Option'], 
	'options' => ['class' => 'form-control'],
	'addon' => ['prepend' => 'Select']
]);

echo $form->field($model, 'attribute')->widget(Select2::className(), [
	'items' => ['first' => 'First Option', 'second' => 'Second Option', 'third' => 'Third Option'], 
	'options' => ['class' => 'form-control'],
	'addon' => ['prepend' => 'Select']
]);
```

Property
--------

- `items` is an array data option.
- `addon` adding bootstrap input group like `append` or `prepend`.
- `language` select2 locale language.
- `multiple` set `true` for multiple selection.
- `size` sizing a dropdownlist. valid value are `lg` or `Select2::LARGE` and `sm` or `Select2::SMALL`.
- `events` the event handlers for the underlying Select2 Javascript plugin.

example :
```
<?php
use bootui\select2\Select2;

echo $form->field($model, 'attribute1')->widget(Select2::className(), [
	'items' => ['first' => 'First Option', 'second' => 'Second Option', 'third' => 'Third Option'], 
	'size' => Select2::LARGE,
	'addon' => [
		'prepend' => [Html::a('btn1', '#', ['class' => 'btn btn-default']), true], // prepend in single button, format [String $content, Boolean $asButton]
		'append' => [ // append in multiple button.
			[bootui\Button::widget(['label' => 'btn 2']), true],
			[bootui\Button::className(), ['label' => 'btn 3'], true], // format [$className, Array $config, Boolean $asButton]
		],
	],
]);

echo $form->field($model, 'attribute2')->widget(Select2::className(), [
	'items' => ['data1' => 'First Data', 'data2' => 'Second Data', 'data3' => 'Third Data'], 
	'events' => [
		'select2-opening' => 'function() { log("opening"); }',
		'select2-open' => 'function() { log("open"); }',
		'select2-close' => 'function() { log("close"); }',
	],
	'addon' => [
		'prepend' => 'Select Data',
	],
]);
```

More property see [Select2 Documentation](http://ivaynberg.github.io/select2/#documentation)

example for use a `function` or `object` type :

```
<?php
echo Select2::widget([
	//jquery inline function
	'formatResult' => 'function format(state) { if (!state.id) return state.text;return "" + state.text;}',

	//call existing function
	'formatSelection' => 'js:formatSelection()',

	//object
	'data' => 'js:[{id:0,text:"enhancement"},{id:1,text:"bug"},{id:2,text:"duplicate"},{id:3,text:"invalid"},{id:4,text:"wontfix"}]',
]);
```
