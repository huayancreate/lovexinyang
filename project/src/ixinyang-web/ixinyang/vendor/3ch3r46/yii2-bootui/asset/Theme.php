<?php
namespace bootui\asset;
/**
 * Bootstrap Theme Asset
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class Theme extends Asset
{
	public $css = [
	'css/bootstrap-theme.css',
	];
	
	public $depends = [
	'bootui\asset\CoreCss',
	];
}