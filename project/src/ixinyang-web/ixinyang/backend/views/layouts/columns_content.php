<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use backend\models\TMenu;
use yii\bootstrap\Alert;

AppAsset::register($this);
?>
<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<!--左侧菜单-->
<?= Yii::$app->cache->get('menulist-' . Yii::$app->user->id) ?>
<!--内容块-->
<article>
    <section class="wrap">
        <figure>
            <figcaption class="wrap_caption"></figcaption>
                <?php
                    //错误信息提示
                    if (Yii::$app->getSession()->hasFlash('error')) {
                        echo Alert::widget([
                            'options' => [
                                'class' => 'alert alert-warning',
                            ],
                            'body' => Yii::$app->getSession()->getFlash('error'),
                        ]);
                    }
                    //普通信息提示
                    if (Yii::$app->getSession()->hasFlash('success')) {
                        echo Alert::widget([
                            'options' => [
                                'class' => 'alert-success', //这里是提示框的class
                            ],
                            'body' => Yii::$app->getSession()->getFlash('success'), //消息体
                        ]);
                    }
                ?>
                <?= $content ?>
        </figure>
    </section>
</article>

<?php $this->endContent(); ?>

<?php $this->beginBlock('JS_MENU') ?>
<script type="text/javascript">

<?php $this->endBlock() ?>
</script>  
<?php
\yii\web\YiiAsset::register($this);
$this->registerJs($this->blocks['JS_MENU'], \yii\web\View::POS_END);
?> 