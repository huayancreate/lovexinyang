<?php
namespace bootui\asset;
/**
 * Renderer bootstrap js asset.
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class CoreJs extends Asset
{
	public $js = [
		'js/bootstrap.js',
	];
	
	public $depends = [
		'yii\web\JqueryAsset',
		'bootui\asset\CoreCss',
	];
}