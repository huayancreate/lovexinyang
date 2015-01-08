<?php
use yii\helpers\Url;
?>

<aside id="left_menu">
	<ul>
		<?php foreach ($list as $father):?>
				<?php if($father->parentid==0):?>
					<li>
						<details open>
							<summary><?= $father->menuname ?></summary>
						<?php foreach ($list as $p):?>
							<?php if($father->id==$p->parentid):?>
								<a href="<?=Url::to('index.php?r='.$p['route'])?>"> <?= $p->menuname ?> </a>
							<?php endif ?>
						<?php endforeach; ?>
						</details>
					</li>
				<?php endif ?>
		<?php endforeach; ?>
	</ul>
</aside>
  
