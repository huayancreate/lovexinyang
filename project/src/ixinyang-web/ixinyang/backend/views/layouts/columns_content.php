<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hy\widgets\AreaDecorator;
use yii\widgets\Block;

AppAsset::register($this);
?>
<?php AreaDecorator::begin(['viewFile'=>'@app/views/layouts/columns_breadcrumbs.php'])?>
        
        <?php Block::begin(['id' =>'content']);?>
                <div class="span4">
                   <?= $rightData ?>
                </div>
        <?php Block::end();?>

<?php AreaDecorator::end();?>