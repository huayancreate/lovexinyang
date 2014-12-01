<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hy\widgets\AreaDecorator;
use yii\widgets\Block;

AppAsset::register($this);
?>
<?php AreaDecorator::begin(['viewFile'=>'@app/views/layouts/columns_navbar.php'])?>
        <?php Block::begin(['id' =>'breadcrumbs']);?>
          <?= $breadcrumbs ?>
        <?php Block::end();?>
        
        <?php Block::begin(['id' =>'content']);?>
          <?= $content ?>
        <?php Block::end();?>

        <?php Block::begin(['id' =>'footer']);?>
          <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
          <p class="pull-right"><?= Yii::powered() ?></p>
        <?php Block::end();?>

<?php AreaDecorator::end();?>