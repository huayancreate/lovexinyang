<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="css/public.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="css/login_register.css" rel="stylesheet" type="text/css" />
    <?php $this->registerCssFile("assets/43cf4500/css/bootstrap.css"); ?>
    <?php $this->head() ?>
</head>
<body style="background:url(<?=  Yii::$app->urlManager->baseUrl ?>/images/login_bg.png) no-repeat top center">
    <?php $this->beginBody() ?>

        <header class="top_title">
            <div class="wrap_content_box">
                <div class="top_logo"><a class="logo" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index"><img src="images/login_logo.png" /></a></div>

            </div>
        </header>
    <section class="wrap_content_box">
    <div class="wrap">

        <?= $content ?>
    </div>
    </section>

    <footer>
        <div class="wrap_content_box footer_bottom">
            <address class="footer_bottom_up">Copyright&nbsp;&copy;&nbsp;2014<a href="#">爱信阳</a>版权所有<a href="#">皖ICP备201400001号</a><a href="#">京公网安备11010502025545号</a><a href="#">电子公告服务规则</a>技术支持：<a href="http://www.huayancreate.com" target="_blank">安徽华研电子科技</a></address>
            <div class="footer_bottom_down"><a href="#" target="_blank"><img src="images/footer01.jpg" /></a><a href="#" target="_blank"><img src="images/footer02.jpg" /></a><a href="#" target="_blank"><img src="images/footer03.jpg" /></a><a href="#" target="_blank"><img src="images/footer04.jpg" /></a></div>
        </div><!--footer_bottom  end-->
    </footer>
    <!--footer  end-->

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
