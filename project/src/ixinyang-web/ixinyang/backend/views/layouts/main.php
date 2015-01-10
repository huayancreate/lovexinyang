<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use yii\helpers\ArrayHelper;

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
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <header>
    <div class="wrap_content_box">
        <div id="left_logo"></div>
        <a href="#">返回首页</a>
        <a href="#">修改密码</a>
        <?=Html::a('退出', ['site/logout'], [
            'data' => [
                'method' => 'post',
            ],
        ])?>
        <span>欢迎您，<strong><?= Yii::$app->user->identity->username ?></strong></span>
        <div class="clearfloat"></div>
    </div>
    </header>
    
    <section class="wrap_content_box"> 
        <?= $content ?>
    </section>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
