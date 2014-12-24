<?php
namespace bootui;

use yii\helpers\ArrayHelper;

use Yii;
use yii\helpers\Html;
/**
 * Bootstrap ActiveForm Widget.
 * ~~~
 * ```php
 * <?php
 * $form = bootui\ActiveForm::begin(['type' => 'vertical']);
 * 
 *      echo Html::tag('h1', 'Sign In Form', ['class' => 'page-header']);
 * 
 *      echo $form->field($model, 'username')->textInput()->prepend('Username')->hiddenLabel();
 * 
 *      echo $form->field($model, 'password')->passwordInput()->prepend('Password')->hiddenLabel();
 * 
 *      echo Button::widget(['label' => 'Sign In', 'buttonType' => 'submit']);
 * 
 * bootui\ActiveForm::end();
 * ```
 * ~~~
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class ActiveForm extends \yii\widgets\ActiveForm
{
	// Type of bootstrap form
	const HORIZONTAL = 'horizontal';
	const VERTICAL = 'vertical';
	const INLINE = 'inline';
	
	/**
	 * @var string type of this form.
	 * valid value are 'horizontal','vertical', and 'inline'.
	 */
	public $layout = 'vertical';
	
	public $leftLabel = false;
	
	public $hideLabelOnInline = true;
	
	public function init()
	{
		if ($this->layout == self::HORIZONTAL)
			Html::addCssClass($this->options, 'form-' . self::HORIZONTAL);
		elseif ($this->layout == self::VERTICAL)
			Html::addCssClass($this->options, 'form-' . self::VERTICAL);
		elseif ($this->layout == self::INLINE)
			Html::addCssClass($this->options, 'form-' . self::INLINE);

		$this->fieldConfig['class'] = ActiveField::className();
		return parent::init();
	}
	
	/**
	 * @param Model|ActiveRecord $model active model
	 * @param string $attribute of model
	 * @return ActiveField
	 */
	public function field($model, $attribute, $options = [])
	{
		$options['formType'] = $this->layout;
		$options['leftLabel'] = $this->leftLabel;
			
		return Yii::createObject(array_merge($this->fieldConfig, $options, [
			'model' => $model,
			'attribute' => $attribute,
			'form' => $this,
		]));
	}
	
	public function label($content, $options = [])
	{
		if ($this->leftLabel)
			Html::addCssStyle($options, 'text-align: left;');
		Html::addCssClass($options, 'control-label');
		return Html::label($content, null, $options);
	}
	
	public function errorSummary($models, $options = [])
	{
		Html::addCssClass($options, 'alert alert-danger');
		return parent::errorSummary($models, $options);
	}
}
