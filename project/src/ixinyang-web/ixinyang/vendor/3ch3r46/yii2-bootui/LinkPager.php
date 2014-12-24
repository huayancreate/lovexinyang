<?php
namespace bootui;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * LinkPager Class File.
 * @author Moh Khoirul Anam <3ch3r46@gmail.com>
 * @copyright 2014
 * @since 1
 *
 */
class LinkPager extends \yii\widgets\LinkPager
{
	public $options = ['class' => 'pager'];
	
	public $internalPage = false;
	
	public $nextPageLabel = 'Older &rarr;';
	
	public $prevPageLabel = '&larr; Newer';
	
	public function init()
	{
		parent::init();
	}
	
	public function run()
	{
		if ($this->pagination->getPageCount() != 1)
			echo $this->renderPageButtons();
	}

	protected function renderPageButtons()
	{
		$buttons = [];
		
		$pageCount = $this->pagination->getPageCount();
		$currentPage = $this->pagination->getPage();
		
		// first page
		if ($this->firstPageLabel !== null) {
			$buttons[] = $this->renderPageButton($this->firstPageLabel, 0, $this->firstPageCssClass, $currentPage <= 0, false);
		}
		
		// prev page
		if ($this->prevPageLabel !== null) {
			if (($page = $currentPage - 1) < 0) {
				$page = 0;
			}
			$buttons[] = $this->renderPageButton($this->prevPageLabel, $page, $this->prevPageCssClass, $currentPage <= 0, false);
		}
		
		// internal pages
		if ($this->internalPage) {
			list($beginPage, $endPage) = $this->getPageRange();
			for ($i = $beginPage; $i <= $endPage; ++$i) {
				$buttons[] = $this->renderPageButton($i + 1, $i, null, false, $i == $currentPage);
			}
		}
		
		// next page
		if ($this->nextPageLabel !== null) {
			if (($page = $currentPage + 1) >= $pageCount - 1) {
				$page = $pageCount - 1;
			}
			$buttons[] = $this->renderPageButton($this->nextPageLabel, $page, $this->nextPageCssClass, $currentPage >= $pageCount - 1, false);
		}
		
		// last page
		if ($this->lastPageLabel !== null) {
			$buttons[] = $this->renderPageButton($this->lastPageLabel, $pageCount - 1, $this->lastPageCssClass, $currentPage >= $pageCount - 1, false);
		}
		
		return Html::tag('ul', implode("\n", $buttons), $this->options);
	}
	
	/**
	 * Renders a page button.
	 * You may override this method to customize the generation of page buttons.
	 * @param string $label the text label for the button
	 * @param integer $page the page number
	 * @param string $class the CSS class for the page button.
	 * @param boolean $disabled whether this page button is disabled
	 * @param boolean $active whether this page button is active
	 * @return string the rendering result
	 */
	protected function renderPageButton($label, $page, $class, $disabled, $active)
	{
		$options = ['class' => $class === '' ? null : $class];
		if ($active) {
			Html::addCssClass($options, $this->activePageCssClass);
		}
		if ($disabled) {
			Html::addCssClass($options, $this->disabledPageCssClass);
	
			return Html::tag('li', Html::tag('span', $label), $options);
		}
		$linkOptions = $this->linkOptions;
		$linkOptions['data-page'] = $page;
	
		return Html::tag('li', Html::a($label, $this->createUrl($page), $linkOptions), $options);
	}
	
	/**
	 * Creates the URL suitable for pagination with the specified page number.
	 * This method is mainly called by pagers when creating URLs used to perform pagination.
	 * @param integer $page the zero-based page number that the URL should point to.
	 * @param boolean $absolute whether to create an absolute URL. Defaults to `false`.
	 * @return string the created URL
	 * @see params
	 * @see forcePageParam
	 */
	public function createUrl($page, $absolute = false)
	{
		if (($params = $this->pagination->params) === null) {
			$request = Yii::$app->getRequest();
			$params = $request instanceof Request ? $request->getQueryParams() : [];
		}
		if ($page > 0 || $page >= 0 && $this->pagination->forcePageParam) {
			$params[$this->pagination->pageParam] = $page + 1;
		} else {
			unset($params[$this->pagination->pageParam]);
		}

		$params[0] = $this->pagination->route === null ? Yii::$app->controller->getRoute() : $this->pagination->route;
		$urlManager = $this->pagination->urlManager === null ? Yii::$app->getUrlManager() : $this->pagination->urlManager;
		if ($absolute) {
			return $urlManager->createAbsoluteUrl($params);
		} else {
			return $urlManager->createUrl($params);
		}
	}
}