<?php
namespace bootui\asset;
/**
 * Minified Bootstrap Theme Asset
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class ThemeMin extends Asset
{
	public $css = [
	'css/bootstrap-theme.min.css',
	];
	
	public $depends = [
	'bootui\asset\CoreCssMin',
	];
}