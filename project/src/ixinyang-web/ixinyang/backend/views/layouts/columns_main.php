<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hy\widgets\AreaDecorator;
use yii\widgets\Block;

AppAsset::register($this);
?>
<?php AreaDecorator::begin(['viewFile'=>'@app/views/layouts/columns_right.php'])?>
        <?php Block::begin(['id' =>'mainData']);?>
        	<?= $content ?>
        <?php Block::end();?>

<?php AreaDecorator::end();?>