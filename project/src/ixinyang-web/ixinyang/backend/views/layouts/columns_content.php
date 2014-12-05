<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginContent('@app/views/layouts/main.php');?>
	<div class="col-lg-3">
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
	</div>
	<div class="col-lg-9">
    	<?= $content ?>
	</div>

<?php $this->endContent();?>