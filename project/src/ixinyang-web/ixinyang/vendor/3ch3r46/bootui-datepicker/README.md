3ch3r46/bootui-datepicker
============================
The Bootstrap Datepicker extension for yii framework

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist 3ch3r46/bootui-datepicker "*"
```

or add

```
"3ch3r46/bootui-datepicker": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```
<?php
use bootui\datepicker\Datepicker;

echo $form->field($model, 'attribute')->widget(Datepicker::className(), [
	'format' => 'yyyy-mm-dd',
	'addon' => [
		'prepend' => [Html::a('btn1', '#', ['class' => 'btn btn-default']), true], // prepend in single button, format [String $content, Boolean $asButton]
		'append' => [ // append in multiple button.
			[bootui\Button::widget(['label' => 'btn 2']), true],
			[bootui\Button::className(), ['label' => 'btn 3'], true], // format [$className, Array $config, Boolean $asButton]
		],
	],
]);

echo Datepicker::widget([
	'model' => $model,
	'attribute' => 'date',
	'format' => 'yyyy-mm-dd',
]);

echo Datepicker::widget([
	'name' => 'date-create',
	'value' => '2014-05-26',
	'format' => 'yyyy-mm-dd',
]);

?>


```

Property Datepicker
-------------------

- boolean `$autoclose` default value `true`
- boolean `$todayHighlight` default value `true`
- string `$format` default value `yyyy-mm-dd`
- boolean `$multidate` default value `false`
- string `$multidateSeparator` default value `,`
- string `$daysOfWeekDisabled` example value `0,1` disable the first and second day in week.
- boolean `$calendarWeeks` default value `false`
- boolean `$forceParse` default value `true`
- boolean|string `$todayBtn` example value `false`, `true`, or string `linked`.
- string `$language` example value `en`
- integer `$weekStart` example value `3` start week from `wednesday`

