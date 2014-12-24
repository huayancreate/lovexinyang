<?php
namespace bootui\asset;
/**
 * Renderer core js bootstrap minified asset
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class CoreJsMin extends Asset
{
	public $js = [
		'js/bootstrap.min.js',
	];
	
	public $depends = [
	'yii\web\JqueryAsset',
	'bootui\asset\CoreCssMin',
	];
}