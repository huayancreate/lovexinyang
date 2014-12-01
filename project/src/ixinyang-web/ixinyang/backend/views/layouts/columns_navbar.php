<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hy\widgets\AreaDecorator;
use yii\widgets\Block;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

AppAsset::register($this);
?>
<?php AreaDecorator::begin(['viewFile'=>'@app/views/layouts/main.php'])?>
		<?php Block::begin(['id' =>'navbar']);?>
		<?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
        <?php Block::end();?>

		<?php Block::begin(['id' =>'breadcrumbs']);?>
          <?= $breadcrumbs ?>
        <?php Block::end();?>
        
        <?php Block::begin(['id' =>'content']);?>
          <?= $content ?>
        <?php Block::end();?>

        <?php Block::begin(['id' =>'footer']);?>
          <?= $footer ?>
        <?php Block::end();?>

<?php AreaDecorator::end();?>