<?php
namespace bootui\asset;
/**
 * Renderer bootstrap core asset
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 */
class CoreAsset extends Asset
{
	public $depends = [
		'bootui\asset\CoreCss',
		'bootui\asset\CoreJs',
	];
}