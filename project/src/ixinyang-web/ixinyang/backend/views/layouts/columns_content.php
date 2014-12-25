<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AppAsset::register($this);
?>
<?php $this->beginContent('@app/views/layouts/main.php');?>
	<div class="col-lg-3">
	<?php
		$items = [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        	['label' => 'Home', 'url' => ['site/index'], 'badge' => '5','items' => [
            	['label' => '角色管理', 'url' => ['comrole/index', 'tag' => 'new']],
            	['label' => '店铺信息', 'url' => ['stostoreinfo/index', 'tag' => 'popular']],
            	['label' => '商品管理', 'url' => ['sto-goods/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        	]],
        // 'Products' menu item will be selected as long as the route is 'product/index'
        	['label' => '权限管理', 'url' => ['product/index'], 'items' => [
            	['label' => '菜单管理', 'url' => ['com-menu/index', 'tag' => 'new']],
        	]],
            ['label' => '系统配置', 'url' => ['product/index'], 'items' => [
                ['label' => '区县和商圈配置', 'url' => ['com-county/index', 'tag' => 'popular']],
            ]],
            ['label' => '客户经理中心', 'url' => ['product/index'], 'items' => [
                ['label' => '洽谈任务页面设计', 'url' => ['sto-apply-info/discusstasks', 'tag' => 'popular']],
                ['label' => '门店信息确认', 'url' => ['shop-info-review/list', 'tag' => 'popular']],

            ]],
            ['label' => '财务管理', 'url' => ['product/index'], 'items' => [
                ['label' => '商家结款审核', 'url' => ['sto-balance-review/index', 'tag' => 'popular']],

            ]],
			['label' => '财务合同管理', 'url' => '#', 'items' => [
				['label' => '财务数据', 'url' => ['sto-seller-info/index', 'tag' => 'new']],
			]],
			['label' => '审核管理', 'url' => "#", 'items' => [
                ['label' => '商家申请审核', 'url' => ['sto-apply-info/index', 'tag' => 'popular']],
				['label' => '退款审核', 'url' => ['com-refund-review/index', 'tag' => 'new']],
			]],
             ['label' => '广告管理', 'url' => ['product/index'], 'items' => [
                ['label' => '页头广告设置', 'url' => ['ad-advertisement/index', 'tag' => 'popular']],

            ]],
        	['label' => '登录', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    		];
        echo Menu::widget([
    		'items' => $items,
		]);
	?>
	</div>
	<div class="col-lg-9">
    	<?= $content ?>
	</div>

<?php $this->endContent();?>