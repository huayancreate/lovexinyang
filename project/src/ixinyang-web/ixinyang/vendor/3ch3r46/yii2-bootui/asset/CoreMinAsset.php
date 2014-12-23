<?php
namespace bootui\asset;
/**
 * Renderer bootstrap core minified asset.
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class CoreMinAsset extends Asset
{
	public $depends = [
		'bootui\asset\CoreCssMin',
		'bootui\asset\CoreJsMin',
	];
}