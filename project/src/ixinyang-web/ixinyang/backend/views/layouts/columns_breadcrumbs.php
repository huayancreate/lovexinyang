<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hy\widgets\AreaDecorator;
use yii\widgets\Block;

AppAsset::register($this);
?>
<?php AreaDecorator::begin(['viewFile'=>'@app/views/layouts/columns_footer.php'])?>
        <?php Block::begin(['id' =>'breadcrumbs']);?>
          <div>breadcurmbs</div>
        <?php Block::end();?>
        
        <?php Block::begin(['id' =>'content']);?>
          <?= $content ?>
        <?php Block::end();?>

<?php AreaDecorator::end();?>