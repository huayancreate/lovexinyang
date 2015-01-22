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
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="renderer" content="webkit">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <LINK href="favicon.ico" type="image/x-icon" rel="shortcut icon">
    <?= Html::csrfMetaTags() ?>
    <?php $this->head() ?>
    <link rel="stylesheet" href="<?=  Yii::$app->urlManager->baseUrl ?>/assets/43cf4500/css/bootstrap.css">
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

    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
<?php $this->endPage() ?>
