<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php $this->head() ?>
    <LINK href="favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link href="css/public.css" rel="stylesheet" type="text/css" />
    <link href="css/index.css" rel="stylesheet" type="text/css" />
    <script src="assets/lazyload/jquery.lazyload.min.js"></script>

    <!--[if IE]>
    <link href="../../common/statics/css/bootstrap-ie7.css" rel="stylesheet" type="text/css" />
    <script src="../../common/statics/js/html5shiv.min.js"></script>
    <script src="../../common/statics/js/respond.min.js"></script>
    <script src="../../common/statics/js/html5.js"></script>
    <script type="text/javascript" src="../../common/statics/js/jquery.placeholder.min.js"></script>
    <![endif]-->
    <?php $this->beginBlock('JS_END'); ?>
    var BASEURL = '<?= Yii::$app->urlManager->baseUrl?>';
    <?php $this->endBlock(); ?>
    <?php $this->registerJs($this->blocks['JS_END'], \yii\web\View::POS_HEAD); ?>
    <title><?= Html::encode($this->title!=null?$this->title.' | ':'')."爱生活，每天多一点" ?></title>
    <!--[if IE]>
    <script type="text/javascript">
        $(function () {
            $('input, textarea').placeholder();
        });
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
                $('input').each(function(){
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
<body>
<?php $this->beginBody() ?>

<?= $content ?>

<footer>
    <div class="footer_top_message">
        <section class="wrap_content_box">
            <ul>
                <li>
                    <figure>
                        <figcaption class="footer_top_message_caption"><a href="#">常见问题</a></figcaption>
                        <a class="footer_top_message_details" href="#">验证问题</a>
                        <a class="footer_top_message_details" href="#">结款问题</a>
                        <a class="footer_top_message_details" href="#">文案图片</a>
                    </figure>
                </li>
                <li>
                    <figure>
                        <figcaption class="footer_top_message_caption"><a href="#">商务合作</a></figcaption>
                        <a class="footer_top_message_details" href="#">合作流程</a>
                        <a class="footer_top_message_details" href="#">商务合同</a>
                        <a class="footer_top_message_details" href="#">市场合作</a>
                    </figure>
                </li>
                <li>
                    <figure>
                        <figcaption class="footer_top_message_caption"><a href="#">公司信息</a></figcaption>
                        <a class="footer_top_message_details" href="#">公司简介</a>
                        <a class="footer_top_message_details" href="#">荣誉资质</a>
                        <a class="footer_top_message_details" href="#">联系方式</a>
                    </figure>
                </li>
                <li class="last">
                    <figure>
                        <figcaption class="footer_top_message_caption"><a href="#">联系客服</a></figcaption>
                        <span class="footer_top_message_details">客服热线：400-400-4000</span>
                        <span class="footer_top_message_details">服务时间：<br />周一至周五&nbsp;&nbsp;09:00--18:00</span>
                    </figure>
                </li>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </div><!--footer_top_message  end-->
    <div class="footer_center_menu">
        <nav class="wrap_content_box">
            <a href="#">关于爱信阳</a><a href="#">商家入驻</a><a href="#">品牌合作专区</a><a href="#">商务合作</a><a href="#">网站联盟</a><a href="#">媒体报道</a><a href="#">加入爱信阳</a><a href="#">友情链接</a>
            <div class="clearfloat"></div>
        </nav>
    </div><!--footer_center_menu  end-->
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
