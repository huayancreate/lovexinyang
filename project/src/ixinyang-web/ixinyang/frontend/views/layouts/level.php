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
    <title><?= Html::encode($this->title)."-爱生活，每天多一点" ?></title>
    <LINK href="favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link href="css/public.css" rel="stylesheet" type="text/css" />
    <link href="css/login.css" rel="stylesheet" type="text/css" />
    <link href="css/login_register.css" rel="stylesheet" type="text/css" />
    <?php $this->registerCssFile("assets/43cf4500/css/bootstrap.css"); ?>
    <?php $this->head() ?>
    <!--[if IE]>
    <link href="../../common/statics/css/bootstrap-ie7.css" rel="stylesheet" type="text/css" />
    <script src="../../common/statics/js/html5shiv.min.js"></script>
    <script src="../../common/statics/js/respond.min.js"></script>
    <script src="../../common/statics/js/html5.js"></script>
    <script type="text/javascript" src="../../common/statics/js/jquery.placeholder.min.js"></script>
    <![endif]-->
    <!--[if IE]>
    <script type="text/javascript">

        $(function(){
            //判断浏览器是否支持placeholder属性
            supportPlaceholder= 'placeholder' in document.createElement('input'),
                placeholders=function(input){
                    var text = input.attr('placeholder'),
                        defaultValue = input.defaultValue;
                    if(!defaultValue){
                        input.val(text).addClass("phcolor");
                    }
                    input.focus(function(){
                        if(input.val() == text){
                            $(this).val("");
                        }
                    });
                    input.blur(function(){
                        if(input.val() == ""){
                            $(this).val(text).addClass("phcolor");
                        }
                    });
                    //输入的字符不为灰色
                    input.keydown(function(){
                        $(this).removeClass("phcolor");
                    });
                };
            //当浏览器不支持placeholder属性时，调用placeholder函数
            if(!supportPlaceholder){
                $('input[type!="checkbox"]').each(function(){
                    text = $(this).attr("placeholder");
                    if($(this).attr("type") == "text"){
                        placeholders($(this));
                    }
                });
            }
        });
    </script>
    <![endif]-->
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
