<?php
namespace bootui\datepicker;

use yii\web\AssetBundle;
/**
 * Bootstrap Asset Bundle
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class DatepickerPlugin extends AssetBundle
{
	public $sourcePath = '@bootui/datepicker/dist';
	
	public $css = [
		'css/datepicker.css',
		'css/datepicker3.css',
		'css/input-group-addon.css',
	];
	
	public $js = [
		'js/bootstrap-datepicker.js',
	];
	
	public $depends = [
		'yii\web\JqueryAsset',
	];
}