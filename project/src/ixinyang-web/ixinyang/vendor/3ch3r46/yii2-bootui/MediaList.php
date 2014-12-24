<?php
namespace bootui;

use yii\helpers\Html;
use yii\base\InvalidConfigException;
/**
 * MediaList renderer the bootstrap media list object.
 * Abstract object styles for building various types of components (like blog comments, Tweets, etc) 
 * that feature a left- or right-aligned image alongside textual content.
 * The default media allow to float a media object (images, video, audio) to the left or right of a content block.
 * 
 * Config options this widget:
 * - `items` is an array media list item. See items option.
 * - `pullImageAll` is an alignment of image. valid value are `left` or `right`.
 * 
 * Item config options:
 * - `images` to set media image with link to image. image is required.
 * - `heading` to set the media heading or title of media list item. heading is required.
 * - `content` to set the media content. content is required.
 * - `url` use this with absolute url or array url.
 * 
 * Example :
 * ```php
 * <?php
 * echo bootui\MediaList::widget([
 * 	'items' => [
 * 		[
 * 			'heading' => 'First Media',
 * 			'content' => 'Text content in here . . .',
 * 			'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
 * 		],
 * 		[
 * 			'heading' => 'Second Media',
 * 			'content' => 'Text content in here . . .',
 * 			'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon',
 * 			'items' => [
 * 				[
 * 					'heading' => 'First Sub Media',
 * 					'content' => 'Text content in here . . .',
 * 					'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
 * 				],
 * 				[
 * 					'heading' => 'Second Sub Media',
 * 					'content' => 'Text content in here . . .',
 * 					'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon',
 * 					'items' => [
 * 						[
 * 							'heading' => 'First Sub Media',
 * 							'content' => 'Text content in here . . .',
 * 							'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
 * 						],
 * 					],
 * 				],
 * 			],
 * 		],
 * 		[
 * 			'heading' => 'Third Media',
 * 			'content' => 'Text content in here . . .',
 * 			'images' => 'http://www.gravatar.com/avatar/' . md5('3ch3r46@gmail.com') . '?d=identicon'
 * 		]
 * 	],	
 * ]);
 * ```
 * 
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class MediaList extends Widget
{
	/**
	 * @var array of list items in medialist
	 */
	public $items = [];
	/**
	 * @var pull all the images is left or right
	 * default are left.
	 */
	public $pullImageAll;
	/**
	 * create the media list function
	 * @return string
	 */
	protected function createMedia($options)
	{
		extract($options);
		
		if (!isset($images))
			throw new InvalidConfigException("The 'images' option is required");
		
		if (!isset($url))
			$url = '#';
		
		if (!isset($heading))
			throw new InvalidConfigException("The 'heading' option is required");
		
		if (!isset($content))
			throw new InvalidConfigException("The 'content' option is required");

		if(!isset($pull)) {
			if (isset($this->pullImageAll)) 
				$pull = $this->pullImageAll;
			else
				$pull = 'left';
		}

		if (!isset($alt))
			$alt = Html::encode($heading);
		
		$mediaImage = Html::a(Html::img($images, ['alt' => $alt, 'class' => 'media-object']), $url, ['class' => 'pull-' . $pull]);
		
		$mediaHeading = Html::tag('h4', $heading, ['class' => 'media-heading']);
		
		$mediaBody = Html::tag('div', $mediaHeading . $content, ['class' => 'media-body']);
		
		$media = $mediaImage . $mediaBody;

		return Html::tag('div', $media, ['class' => 'media']);
	}
	/**
	 * create the sum list item of list items
	 * @param array $datas
	 * @return string
	 */
	public function subMedia($datas){
		$media = [];
		
		foreach ($datas as $data){
			
			if(isset($data['items'])){

				$data['content'] .= $this->subMedia($data['items']);
				$media[] = $this->createMedia($data);
			
			}
			else 
				$media[] = $this->createMedia($data);
		}
		$media = implode('', $media);
		return Html::tag('div', $media, ['class' => 'media-list']);
	}
	/**
	 * run this widgets(non-PHPdoc)
	 * @see CWidget::run()
	 */
	public function run(){
		return $this->subMedia($this->items);
	}
}