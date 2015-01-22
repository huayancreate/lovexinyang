<?php $this->registerCssFile("css/topbar.css"); ?>
<?php $this->registerCssFile("css/mei.css"); ?>
<script src="assets/sea.js"></script>
<script>
    // seajs 的简单配置
    seajs.config({
        base: "../web/js/"
    });
    window.Ixy || (window.Ixy = new Object);
    <?php if(!isset($topbar) ){  // 判断是否需要搜索栏 未初始化$topbar 则需要 ，否则则不需要?>
    seajs.use('site/ibar', function () {
        new Ixy.app.iBar;
    });
    <?php } ?>
    seajs.use('site/tbar', function () {
        new Ixy.app.tBar;
    });

</script>
<header>
   <div class="header_center_title">
        <section class="wrap_content_box" id="topBar">
            <?php
            if (Yii::$app->user->isGuest) {
                ?>
                <div class="header_center_title_left">爱生活，每天多一点！<a href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/login"><b>请登录</b></a><i>|</i><span><a href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/signup"><b>快速注册</b></a></span></div>
            <?php
            }else{
                ?>

                <div class="header_center_title_left">欢迎您，<a href="#"><b><?= Yii::$app->user->identity->userName===null? Yii::$app->user->identity->userAccount : Yii::$app->user->identity->userName?></b></a>
                    <a data-method="post" href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/logout">退出</a><i>|</i>
                    <a class="dropdown-a">
                    <span class="dropdown-toggle"  data-plugin="tBarMsg">
                     <i class="icon-bell-alt"></i>
                     消息 <span class="badge badge-success"></span></span>
                    </a>
                </div>
            <?php
            }
            ?>
            <div class="header_center_title_right">
                <span class="dropdown-a">
                    <a class="" href="#">我的爱生活&nbsp;<s class="icon_arrow_down"></s></a>
                    <ul  class="dropdown-menu dropdown-menu--text dropdown-menu--account account-menu" id="account-menu">
                        <li><a href="http://www.meituan.com/orders/"  class="dropdown-menu__item ">我的订单</a></li>
                        <li><a href="http://www.meituan.com/rates/" class="dropdown-menu__item  ">我的评价</a></li>
                        <li><a href="http://www.meituan.com/collections/"class="dropdown-menu__item  ">我的收藏</a></li>
                        <li><a href="http://www.meituan.com/points/" class="dropdown-menu__item  ">我的积分</a></li>
                        <li><a href="http://www.meituan.com/card/list" class="dropdown-menu__item  ">抵用券</a></li>
                        <li><a href="http://www.meituan.com/account/credit" class="dropdown-menu__item  ">美团余额</a></li>
                        <li><a href="http://www.meituan.com/account/charge"  class="dropdown-menu__item  ">账户充值</a></li>
                        <li><a href="http://www.meituan.com/account/settings" class="dropdown-menu__item ">账户设置</a></li>
                    </ul>
                </span><i>|</i>
                <span class="sele_list"><a href="#">订单查询</a></span><i>|</i>
                <a href="#">联系客服</a><i>|</i>
                <a href="#" id="sn_mobie"><i class="icon-mobile-phone"></i>手机爱生活</a>
            </div>
            <div class="clearfloat"></div>
        </section>
    </div>
    <!-- header_center_title 头部页眉  end-->

    <?php if(!isset($topbar) ){  // 判断是否需要搜索栏 未初始化$topbar 则需要 ，否则则不需要?>
    <div class="header_center_content">
        <section class="wrap_content_box">
            <aside class="header_left">
                <img src="images/logo.jpg" width="119" height="81" />
                <div class="header_left_citylist">
                    <span>信阳市</span>
                </div>
            </aside>
            <article class="header_center">
                <figure class="header_center_search">
                <form action="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=search/index" id="searchForm" method="post">
                    <span class="s_content">
                        <input type="hidden" value="goods" name="type">
                        <div class="tab" id="HeaderSearchTab">
                         <ul class="triggers">
                             <li class="trigger selected"   data-searchtype="goods">商品</li>
                             <li class="trigger"  data-searchtype="shop">店铺</li>
                             </ul>
                             <s class="icon-search-arrow"></s>
                         </div>
                       <input type="search" list="search_list" autocomplete="on" name="searchWorld"  placeholder="请输入商品名称" />
				    </span>
                    <span class="s_btn" id="searchBtn">搜索</span>
                </form>
                    <div class="clearfloat"></div>
                    <figcaption class="header_hotsearch">热门搜索：<a href="#"><b>信阳美食团购</b></a><a href="#">信阳特产</a><a href="#"><b>宾馆</b></a><a href="#"><b>特色小吃</b></a><a href="#">旅游景点</a><a href="#">美食</a></figcaption>
                </figure>
            </article>
            <!--<aside class="header_right"><a href="#" class="orderset"></a><a href="#" class="orderchart"><span>12999999</span></a><div class="clearfloat"></div></aside>-->
            <div class="clearfloat"></div>
        </section>
    </div>
    <!-- header_center_content 头部中间  end-->

    <div class="header_bottom_menu">
        <nav class="wrap_content_box  header_menu">
            <a href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index">首页</a>
            <a href="#">美食</a>
            <a href="#">酒店/宾馆</a>
            <a href="#">电影</a>
            <a href="#">休闲娱乐</a>
            <a href="#">旅游</a>
            <a href="#">公益</a>
            <div class="clearfloat"></div>
        </nav>
    </div>
    <?php } ?>
    <!-- header_bottom_menu 头部导航  end-->
    </header>
    <!--header  end-->
