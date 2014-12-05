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
<<<<<<< HEAD
		<ul class="list-group">
 			<li class="list-group-item">主页面
 			<span class="badge">14</span>
 			</li>
  			<li class="list-group-item">
  				<?= Html::a('角色管理','index.php?r=comrole/index')?>
  			</li>
  			<li class="list-group-item">
  				<?= Html::a('店铺信息','index.php?r=stostoreinfo/index')?>
  			</li>
  			<li class="list-group-item">
          <?= Html::a('申请分店','index.php?r=shopinforeview/index')?>
        </li>
  			<li class="list-group-item">测试1</li>
		</ul>
=======
	<?php
		$items = [
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default action is used.
        	['label' => 'Home', 'url' => ['site/index'], 'badge' => '5','items' => [
            	['label' => 'New Arrivals', 'url' => ['site/index', 'tag' => 'new']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        	]],
        // 'Products' menu item will be selected as long as the route is 'product/index'
        	['label' => 'Products', 'url' => ['product/index'], 'items' => [
            	['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
            	['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
        	]],
        	['label' => '登录', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
    		];
        echo Menu::widget([
    		'items' => $items,
		]);
	?>
>>>>>>> origin/dev
	</div>
	<div class="col-lg-9">
    	<?= $content ?>
	</div>

<?php $this->endContent();?>