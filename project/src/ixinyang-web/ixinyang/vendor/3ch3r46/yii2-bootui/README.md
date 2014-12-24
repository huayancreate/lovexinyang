3ch3r46/yii2-bootui
===================
The Bootstrap 3 widget for yii 2 framework.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist 3ch3r46/yii2-bootui "*"
```

or add

~~~
"3ch3r46/yii2-bootui": "*"
~~~

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Form
----
Example :
```
<?php
$form = bootui\ActiveForm::begin(['type' => 'vertical']);

     echo Html::tag('h1', 'Sign In Form', ['class' => 'page-header']);

     echo $form->field($model, 'username')->textInput()->prepend('Username')->hiddenLabel();

     echo $form->field($model, 'password')->passwordInput()->prepend('Password')->hiddenLabel();

     echo Button::submit('Sign In');

bootui\ActiveForm::end();
```

Property Field :

#### 1. Prepend
Prepend is a Bootstrap feature input group addon. Extend form controls by adding text or buttons before sides of any text-based input. To use this options, follow code below :
for text only
```
<?php
$form->field($model, 'attribute')->prepend('Prepend Text');

```

Prepend for Button, ButtonDropdown, ButtonGroup, ButtonLoading.
```
<?php
$form->field($model, 'attribute')->prepend(ClassName, $buttonConfig);

// Button
$form->field($model, 'attribute')->prepend(Button::className(), ['label' => 'Button']);

// ButtonDropdown
$form->field($model, 'attribute')->prepend(ButtonDropdown::className(), [
	'label' => 'Dropdown', 
	'items' => [
		['label' => 'Index', 'url' => ['index']],
		['label' => 'About', 'url' => ['about']],
		['label' => 'Help', 'url' => ['help']],
	],
]);

// ButtonGroup
$form->field($model, 'attribute')->prepend(ButtonGroup::className(), [
	'buttons' => [
		Button::widget(['label' => 'Index', 'url' => ['index']]),
		Button::widget(['label' => 'About', 'url' => ['about']]),
	],
]);

// ButtonLoading
$form->field($model, 'attribute')->prepend(ButtonLoading::className(), [
	'loadingText' => 'Button is loading . . .',
	'completeText' => 'Button is complete loading . . .',
	'loadingTimeout' => 5, //second
	'completeTimeout' => 2, //second
]);

```

#### 2. Append
Append is a Bootstrap feature input group addon. Extend form controls by adding text or buttons after sides of any text-based input. To use this options, follow code below :

for text only
```
<?php
$form->field($model, 'attribute')->append('Append Text');

```

Append for Button, ButtonDropdown, ButtonGroup, ButtonLoading.
```
<?php
$form->field($model, 'attribute')->append(ClassName, $buttonConfig);

// Button
$form->field($model, 'attribute')->append(bootui\Button::className(), ['label' => 'Button']);

// ButtonDropdown
$form->field($model, 'attribute')->append(bootui\ButtonDropdown::className(), [
	'label' => 'Dropdown', 
	'items' => [
		['label' => 'Index', 'url' => ['index']],
		['label' => 'About', 'url' => ['about']],
		['label' => 'Help', 'url' => ['help']],
	],
]);

// ButtonGroup
$form->field($model, 'attribute')->append(bootui\ButtonGroup::className(), [
	'buttons' => [
		Button::widget(['label' => 'Index', 'url' => ['index']]),
		Button::widget(['label' => 'About', 'url' => ['about']]),
	],
]);

// ButtonLoading
$form->field($model, 'attribute')->append(bootui\ButtonLoading::className(), [
	'loadingText' => 'Button is loading . . .',
	'completeText' => 'Button is complete loading . . .',
	'loadingTimeout' => 5, //second
	'completeTimeout' => 2, //second
]);

```

#### 3. Size
Size type is a bootstrap feature input option. Create taller or shorter form controls that match button sizes. Size valid value are 'sm' (Small), and 'lg' (Large).
To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->size('sm');

```

#### 4. Column Wrapper
Column Wrapper form control is a bootstrap grid system. Wrap input and Wrap label in grid columns, or any custom parent element, to easily enforce desired widths. Valid value is a `string|array` column wrapper valid option value are `label` and `input`. Default value for label `col-sm-3` and input `col-sm-6`. To use this options, follow code below :

Example in array mode:
```
<?php
$form->field($model, 'attribute')->wrap([
	'label' => 'col-sm-3', 
	'input' => 'col-sm-6',
]);
```

Example in string mode:
```
<?php
// please look this wrap('label&input') for use the string mode
// Use for label and input
$form->field($model, 'attribute')->wrap('col-sm-3&col-sm-6');

// Use for label only
$form->field($model, 'attribute')->wrap('col-sm-3&');

// Use for input only
$form->field($model, 'attribute')->wrap('&col-sm-6');
```

#### 5. Hidden Label
Hidden label is an option to hidden a form label. To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->hiddenLabel();

// OR

$form->field($model, 'attribute')->label(false);

```

#### 6. Hidden Error
Hidden error is an option to hidden a error reporting default from yii error. To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->hiddenError();

```

#### 7. Label To Placeholder
Label to placeholder is an option to generate a placeholder in form control from label. To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->labelToPlaceholder();

```

#### 8. Placeholder
Placeholder is an attribute option in default html input element. specifies a short hint that describes the expected valie of an `<input>` and `<textarea>` element. To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->placeholder('placeholder text . . .');

```

#### 9. No Group
No Group is an option to remove from-group from generator field. To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->noGroup();

```

#### 10. Hidden
Hidden is an option to hide a Form Field Label, Form Field Control, Form Field Error, Form Field Hint. To use this options, follow code below :
```
<?php
$form->field($model, 'attribute')->hidden();

```

#### 11. Label
Label is an option to customize label text. To use this options, follow code below :
~~~
<?php
// label($value, $options)
$form->field($model, 'attribute')->label('custom label');

~~~

#### 12. Read Only
Read Only is a default attribute option from html input element. Specifies that an input field is read-only. Use this to readonly for `input`, `textarea`, or `dropdownlist` and `listbox`. To use this options, follow code below :
~~~
<?php
$form->field($model, 'attribute')->readOnly();

~~~

#### 13. Disbaled
Disabled is a default attribute option from html input element. specifies that and <input> element should be disabled. Use this to disabled for `input`, `textarea`, or `dropdownlist` and `listbox`. To use this options, follow code below :
~~~
<?php
$form->field($model, 'attribute')->disabled();

~~~

#### 14. Length (maximum or minimum length)
Length is a default attribute option from html input element (`maxlength` and `minlength`). use this to set input length with max or min. `max` specifies the maximum number of characters allowed an `input` or `textarea` element. `min` specifies the minimum number of characters allowed an `input` or `textarea` element. In string mode have two operator prefix. operator minus `-` is a option for `minlength`. operator plus `+` is a options for `maxlength`. valid value are number or date. To use this options, follow code below :
~~~
<?php
// in array mode
$form->field($model, 'attribute')->length([
		'max' => '255',
		'min' => '10',
]);

// in string mode
$form->field($model, 'attribute')->length('-10&+255');

~~~

#### 15. Inline
Use inline on a series of checkboxes or radios for controls that appear on the same line. Specifies the inline option only for `radioList` and `checkboxList`. To use this options, follow code below :
~~~
<?php
$form->field($model, 'attribute')->checkboxList([
       'first' => 'First List',
       'second' => 'Second List',
       'Third' => 'Third List'
])->inline();

$form->field($model, 'attribute')->radioList([
       'first' => 'First List',
       'second' => 'Second List',
       'Third' => 'Third List'
])->inline();

~~~

#### 16. Button
Use button for `checkboxList` or `radioList` to grouping look like a button group and style toggling for selected list. Specifies option only for `checkboxList` and `radioList`. To use this options, follow code below :
~~~
<?php
$form->field($model, 'attribute')->checkboxList([
       'first' => 'First List',
       'second' => 'Second List',
       'Third' => 'Third List'
])->button();

$form->field($model, 'attribute')->radioList([
       'first' => 'First List',
       'second' => 'Second List',
       'Third' => 'Third List'
])->button();

~~~

#### 17. Button Vertical
Use button for `checkboxList` or `radioList` to grouping look like a button group vertical and style toggling for selected list. Specifies option only for `checkboxList` and `radioList`. To use this options, follow code below :
~~~
<?php
$form->field($model, 'attribute')->checkboxList([
       'first' => 'First List',
       'second' => 'Second List',
       'Third' => 'Third List'
])->buttonVertical();

$form->field($model, 'attribute')->radioList([
       'first' => 'First List',
       'second' => 'Second List',
       'Third' => 'Third List'
])->buttonVertical();

~~~


#### 18. Template
Template is an option from default field in yii input element. this is function to custom template.  To use this options, follow code below :
~~~
<?php
//in string mode
$form->field($model, 'attribute')->template('{label} {input} {error} {hint}');

//in array mode
$form->field($model, 'attribute')->template(['{input}' => '<div class="well">{input}</div>']); 

~~~

Button
------
Button Widget renderer a bootstrap button.

Button renderer more `buttonType` : `default`, `button`, `submit`, `buttonInput`, and `submitInput`.

And have a more `type` bootstrap button:

- `default` or `bootui\Button::TYPE_DEFAULT` is a Standard button.

- `primary` or `bootui\Button::TYPE_PRIMARY` is a Provides extra visual weight and identifies the primary action in a set of buttons.

- `success` or `bootui\Button::TYPE_SUCCESS` is an Indicates a successful or positive action.

- `info` or `bootui\Button::TYPE_INFO` is a Contextual button for informational alert messages.

- `warning` or `bootui\Button::TYPE_WARNING` is an Indicates caution should be taken with this action.

- `danger` or `bootui\Button::TYPE_DANGER` is an Indicates a dangerous or potentially negative action.

- `link` or `bootui\Button::TYPE_LINK` is a Deemphasize a button by making it look like a link while maintaining button behavior.

Sizing a button in option `size` have 3 size : `xs`(Extra Small), `sm` (Small), and `lg` (Large). Don't use size option if you use a default size.

Block a button with option `block` those that span the full width of a parent.

Active State Button with option `active` and valid value are boolean `true` or `false` and buttons will appear pressed (with a darker background, darker border, and inset shadow) when active..

Disable State with option `disable` and valid value are boolean `true` or `false` and make buttons look unclickable by fading them back 50%.

Example in button widget default mode:

~~~
<?php
// default format bootui\Button::widget($config).

// for button mode.

echo bootui\Button::widget([
    'label' => 'Button Action',
    'type' => bootui\Button::TYPE_PRIMARY,
    'buttonType' => 'button',
]);

// for link mode.

echo bootui\Button::widget([
    'label' => 'Button Action',
    'type' => bootui\Button::TYPE_PRIMARY,
    'url' => 'http:://bitbucket.org/3ch3r46',
]);

~~~

Example with other mode:

#### Button Link

link mode in default with array config.

~~~
<?php
echo bootui\Button::link([
    'label' => 'My Home Page Link',
    'url' => 'http:://bitbucket.org/3ch3r46',
    'type' => bootui\Button::TYPE_SUCCESS
]);

~~~

link mode in string config.

~~~
<?php
echo bootui\Button::link('label:My Home Page Link;url:bitbucket.org/3ch3r46;type:primary');

~~~

or link without key config, only for `label` in first config and `url` for second config.

~~~
<?php
echo bootui\Button::link('My Home Page Link;bitbucket.org/3ch3r46;type:primary');

~~~

#### Button Action.

button with array config.

~~~
<?php
echo bootui\Button::button([
    'label' => 'Action',
    'type' => bootui\Button::TYPE_SUCCESS
]);

~~~

button in string config.

~~~
<?php
echo bootui\Button::button('label:Action;type:primary');

~~~

#### Submit Button.

submit button with array config.

~~~
<?php
echo bootui\Button::submit([
    'label' => 'Action',
    'type' => bootui\Button::TYPE_INFO
]);

~~~

submit button in string config.

~~~
<?php
echo bootui\Button::submit('label:Action;type:primary');

~~~

Button Dropdown
---------------
Button Dropdown renderer bootstrap dropdown button.

Config options in button dropdown:

- `type` is a type of button valid value are `default`,`primary`,`success`,`info`,`warning`,`danger`.

- `item` is a list button dropdown.

- `size` is a sizing button valid value are `lg`(Large),`sm`(Small),`xs`(Extra Small).

- `split` is a whether to display a group of split-styled button group.

Example:

Single button dropdown.

~~~
<?php
// default
echo bootui\ButtonDropdown::widget([
    'type'=>bootui\Button::TYPE_SUCCESS,
    'label'=>'button dropdown',
    'size'=>'lg',
    'items'=>[
        ['label'=>'bootstrap','url'=>'http://getBootstrap.com'],
        '---',
        'Dropdown Header One',
        ['label' => 'menu one','url'=>'#'],
        ['label' => 'menu two','url'=>'#'],
        ['label' => 'menu three','url'=>'#'],
        'Dropdown Header Two',
        ['label' => 'menu four','url'=>'#'],
        ['label' => 'menu five','url'=>'#']
    ],
]);

// with button object
echo bootui\Button::dropdown([
    'type'=>bootui\Button::TYPE_INFO,
    'label'=>'button dropdown',
    'size'=>'lg',
    'items'=>[
        ['label'=>'bootstrap','url'=>'http://getBootstrap.com'],
        '---',
        'Dropdown Header One',
        ['label' => 'menu one','url'=>'#'],
        ['label' => 'menu two','url'=>'#'],
        ['label' => 'menu three','url'=>'#'],
        'Dropdown Header Two',
        ['label' => 'menu four','url'=>'#'],
        ['label' => 'menu five','url'=>'#']
    ],
]);

~~~

Split button dropdown.

~~~
<?php
// default
echo bootui\ButtonDropdown::widget([
    'type'=>'success',
    'label'=>'button dropdown',
    'size'=>'lg',
    'split' => true,
    'items'=>[
        ['label'=>'bootstrap','url'=>'http://getBootstrap.com'],
        '---',
        'Dropdown Header One',
        ['label' => 'menu one','url'=>'#'],
        ['label' => 'menu two','url'=>'#'],
        ['label' => 'menu three','url'=>'#'],
        'Dropdown Header Two',
        ['label' => 'menu four','url'=>'#'],
        ['label' => 'menu five','url'=>'#']
    ],
]);

// with button object
echo bootui\Button::dropdown([
    'type'=>bootui\Button::TYPE_WARNING,
    'label'=>'button dropdown',
    'size'=>'lg',
    'split' => true,
    'items'=>[
        ['label'=>'bootstrap','url'=>'http://getBootstrap.com'],
        '---',
        'Dropdown Header One',
        ['label' => 'menu one','url'=>'#'],
        ['label' => 'menu two','url'=>'#'],
        ['label' => 'menu three','url'=>'#'],
        'Dropdown Header Two',
        ['label' => 'menu four','url'=>'#'],
        ['label' => 'menu five','url'=>'#']
    ],
]);

~~~

Button Group
-----------
Group a series of buttons together on a single line with the button group.

Button group have more option :

`buttons` is each array element represents a single button, which can be specified as a string or an array or button object or button dropdown object of the following structure:

- label: string, required, the button label.

- options: array, optional, the HTML attributes of the button.

`size` is a sizing button have 3 size : `xs`(Extra Small), `sm` (Small), and `lg` (Large). Don't use size option if you use a default size.

`vertical` is make a set of buttons appear vertically stacked rather than horizontally.

`justified` is make a group of buttons stretch at equal sizes to span the entire width of its parent. Also works with button dropdowns within the button group.

`block` is a button those that span the full width of a parent.

Example:

~~~
<?php
// default
echo bootui\ButtonGroup::widget([
    'justified'=>true,
    'size' => 'lg',
    'buttons'=>[
        bootui\Button::widget(['label'=>'No One']),
        bootui\Button::widget(['label'=>'No Two']),
        [
            'label'=>'No Three',
            'items' => [
                ['label' => 'dropone'],
                ['label' => 'droptwo'],
            ]
        ]
    ]
]);

// with button object
echo bootui\Button::group([
    'justified'=>true,
    'size' => 'lg',
    'buttons'=>[
        bootui\Button::widget(['label'=>'No One']),
        bootui\Button::widget(['label'=>'No Two']),
        [
            'label'=>'No Three',
            'items' => [
                ['label' => 'dropone'],
                ['label' => 'droptwo'],
            ]
        ]
    ]
]);

~~~

Button Loading
--------------
Sets button state to loading - disables button and swaps text to loading text. Loading text should be defined on the button element.
Config options in button loading:

- `loadingText` is a text if button is loading.

- `completeText` is a text if button is finish loading.

- `loadingTimeOut` is a time to loading a button in second.

- `completeTimeOut` is a time to complete loading a button in second.

- `ajaxEvent` is a javascript event where button running ajax.

Loading button with array config.

~~~
<?php
// default
echo bootui\ButtonLoading::widget([
    'loadingText' => 'I am in loading now',
    'completeText' => 'I am complete now',
    'type' => bootui\Button::TYPE_SUCCESS,
    'loadingTimeOut' => 5, // second.
    'completeTimeOut' => 3, // second.
]);

// with button object
echo bootui\Button::loading([
    'loadingText' => 'I am in loading now',
    'completeText' => 'I am complete now',
    'type' => bootui\Button::TYPE_SUCCESS,
    'loadingTimeOut' => 5, // second.
    'completeTimeOut' => 3, // second.
]);

~~~

Loading button with string config.

~~~
<?php
echo bootui\Button::loading('loadingText:I am in loading now;completeText:I am complete now;type:primary;loadingTimeOut:5;completeTimeOut:3');

~~~


Navigation Bar
--------------
NavBar renderer a bootstrap navigation bar.
Navbars are responsive meta components that serve as navigation headers for your application or site.
They begin collapsed (and are toggleable) in mobile views and become horizontal as the available viewport width increases.

Config Options :

- `brandLabel` is a string the text of the brand.

- `hiddenBrand` set this with array to hidden the brand label where the device width same with class in hidden brand. valid value are `sm` (hidden on small width), `xs` (hidden on extra small width), `md` (hidden on medium width), and `lg` (hidden on large width).

- `brandUrl` is array or string the URL for the brand's hyperlink tag. Defaults to site root.

- `brandOptions` is a HTML attributes of the brand link.

- `padded` is bool whether the navbar content should be included in a `container` div which adds left and right padding. Set this to false for a 100% width navbar.

- `paddedFluid` is bool whether the navbar content should be included in a `fluid-container` div which adds left and right padding.

- `type` string bootstrap navbar type. see type options.

- `fixed` set navigation bar to fixed in top or bottom. set false to static navigation bar

- `items` is array list menu item.

Type bootstrap Options:

- `default` or `bootui\NavBar::TYPE_DEFAULT` is a white gray background color.

- `primary` or `bootui\NavBar::TYPE_PRIMARY` is a blue background color.

- `success` or `bootui\NavBar::TYPE_SUCCESS` is a green background color.

- `info` or `bootui\NavBar::TYPE_INFO` is a medium blue background color.

- `warning` or `bootui\NavBar::TYPE_WARNING` is a yellow background color

- `danger` or `bootui\NavBar::TYPE_DANGER` is a red background color.

- `inverse` or `bootui\NavBar::TYPE_INVERSE` is a black background color.

Example :

~~~
<?php
// Normal Mode
bootui\NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'type' => bootui\NavBar::TYPE_INFO
]);
echo bootui\Nav::widget([
    'items' => [
        ['label' => 'Home', 'url' => '#'],
        ['label' => 'About', 'url' => '#'],
        ['label' => 'Contact', 'url' => '#'],
        ['label' => 'Profile', 'url' => '#'],
        ['label' => 'Content', 'items' => [
            ['label' => 'News', 'url' => '#'],
            ['label' => 'Pages', 'url' => '#'],
            ['label' => 'Files', 'url' => '#'],
        ]],
    ],
    'isNavbar' => true,
]);
bootui\NavBar::end();

// in widget mode
echo bootui\NavBar::widget([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'type' => bootui\NavBar::TYPE_INFO,
    'items' => [
    [
        ['label' => 'Home', 'url' => '#'],
        ['label' => 'About', 'url' => '#'],
        ['label' => 'Contact', 'url' => '#'],
        ['label' => 'Profile', 'url' => '#'],
        ['label' => 'Content', 'items' => [
            ['label' => 'News', 'url' => '#'],
            ['label' => 'Pages', 'url' => '#'],
            ['label' => 'Files', 'url' => '#'],
        ]],
    ],
]]);
~~~

Navigation
----------
Nav renderer a bootstrap navigation.

Config Options:

- `items` is an array lst of items in the nav widget. see Items Config Options.

- `activeParent` set true if parent of the children item is active and parent will active.

- `isNavbar` set true where this nav is use in navbar. see bootui\NavBar example.

- `type` set this to set the navigation type. valid value are `pills` or `bootui\Nav::TYPE_PILLS` and `tabs` or `bootui\Nav::TYPE_TABS`.

- `justified` set true to easily make tabs or pills equal widths of their parent at screens wider than 768px. On smaller screens, the nav links are stacked.

- `stacked` set true whether `pills` or `tabs` are also vertically stackable.

- `collapse` set true whether navigation are also collapse the dropdown menu.

Items Config Options:

- `label` string the nav item label.

- `url` set the absolute url or with array the item's URL. Defaults to "#".

- `visible` set true than this menu item is visible. Defaults to true.

- `linkOptions` is array HTML attributes of the item's link.

- `options` array the HTML attributes of the item container (LI).

- `active` set true than the item on active state or false to not active state.

- `items` array or string render a bootstrap dropdown menu.

Example :

~~~
<?php
echo bootui\Nav::widget([
    'items' => [
        ['label' => 'Home', 'url' => '#'],
        ['label' => 'About', 'url' => '#'],
        ['label' => 'Contact', 'url' => '#'],
        ['label' => 'Profile', 'url' => '#'],
        ['label' => 'Content', 'items' => [
            ['label' => 'News', 'url' => '#'],
            ['label' => 'Pages', 'url' => '#'],
            ['label' => 'Files', 'url' => '#'],
        ]],
    ],
    'type' => bootui\Nav::TYPE_PILLS,
]);
~~~

List Group
----------
ListGroup renderer bootstrap List Group. List groups are a flexible and powerful component for displaying not only simple lists of elements, but complex ones with custom content. The most basic list group is simply an unordered list with list items, and the proper classes

Config options this widget:

- `items` is an array list item. See items option.

- `type` is bootstrap list group type `success`, `info`, `warning`, and `danger`.

- `icon` is a bootstrap glyphicon and set to all list group item.

Item Config Options.

- `label` is string or array to render a content in list item. custom content with `heading` and `text`.

- `url`to linkify list group items by using anchor tags instead of list items.

- `badge` to add the badges component to this list group item and it will automatically be positioned on the right.

- `icon` is a bootstrap glyphicon and set to this list group item.

For Example :

~~~
<?php
echo bootui\ListGroup::widget([
    'items' => [
        'Morbi leo risus', // in string mode will render a label.
        [
            'icon' => 'globe',
            'label' => 'Porta ac consectetur ac',
            'url' => 'http://brother.com',
            'type' => bootui\ListGroup::TYPE_WARNING,
        ],
        'heading=first Heading,text=Cras justo odio', // will render a label with heading and text.
        'label:heading=Second Heading,text=Dapibus ac facilisis in;url:http://brother.com',
        [
            'label' => [
                'heading' => 'Third Heading',
                'text' => 'Vestibulum at eros'
            ],
            'badge' => 46,
        ]
    ],
    'type' => bootui\ListGroup::TYPE_INFO
]);

~~~

Media List
----------
MediaList renderer the bootstrap media list object.
Abstract object styles for building various types of components (like blog comments, Tweets, etc)
that feature a left- or right-aligned image alongside textual content.
The default media allow to float a media object (images, video, audio) to the left or right of a content block.

Config options this widget:

- `items` is an array media list item. See items option.

- `pullImageAll` is an alignment of image. valid value are `left` or `right`.

Item config options:

- `images` to set media image with link to image. image is required.

- `heading` to set the media heading or title of media list item. heading is required.

- `content` to set the media content. content is required.

- `url` use this with absolute url or array url.

Example :

~~~
<?php
echo bootui\MediaList::widget([
    'items' => [
        [
            'heading' => 'First Media',
            'content' => 'Text content in here . . .',
            'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
        ],
        [
            'heading' => 'Second Media',
            'content' => 'Text content in here . . .',
            'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon',
            'items' => [
                [
                    'heading' => 'First Sub Media',
                    'content' => 'Text content in here . . .',
                    'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
                ],
                [
                    'heading' => 'Second Sub Media',
                    'content' => 'Text content in here . . .',
                    'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon',
                    'items' => [
                        [
                            'heading' => 'First Sub Media',
                            'content' => 'Text content in here . . .',
                            'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
                        ],
                    ],
                ],
            ],
        ],
        [
            'heading' => 'Third Media',
            'content' => 'Text content in here . . .',
            'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
        ]
    ],
]);
~~~

Progress Bar
------------
Progress bar renderer bootstrap progress bar.

Provide up-to-date feedback on the progress of a workflow or action with simple yet flexible progress bars.

Config Options:

- `animate` set true to use animation in progress bar.

- `type` the progress bar type. valid value are `success`, `info`, `warning`, `danger`.

- `striped` set the progress bar is striped or not with boolean(`true`|`false`).

- `label` the progress bar caption.

- `percent` integer the amount of progress as a percentage.

Example :

~~~
<?php
echo bootui\Progress::widget([
    'label' => 'Progress bar is running with animation',
    'animate' => true, 
    'percent' => 50, 
    'striped' => true, 
    'type' => bootui\Progress::TYPE_SUCCESS,
]);
~~~