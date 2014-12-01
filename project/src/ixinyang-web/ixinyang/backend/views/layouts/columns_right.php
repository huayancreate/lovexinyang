<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use hy\widgets\AreaDecorator;
use yii\widgets\Block;

AppAsset::register($this);
?>
<?php AreaDecorator::begin(['viewFile'=>'@app/views/layouts/columns_content.php'])?>
        
        <?php Block::begin(['id' =>'rightData']);?>
          <div class="span4">menu</div>
        <?php Block::end();?>
         <div class="span8">
           <?= $mainData ?>
         </div>       

<?php AreaDecorator::end();?>