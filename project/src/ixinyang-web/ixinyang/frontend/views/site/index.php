<?php $this->registerJsFile("assets/43cf4500/js/bootstrap.js"); ?>
<?php $this->registerCssFile("css/topbar.css"); ?>
<?php $this->registerCssFile("css/mei.css"); ?>
<?php $this->registerJsFile("js/site/index.js"); ?>

<?php
if ($headAd !=null && $headAd!='') {
?>
<div id="top_carousel" class="carousel slide header_top_add" data-ride="carousel">
    <ol class="top-carousel-indicators">
        <?php
        for ($i = 0; $i < count($headAd); $i++) {
            ?>
            <li data-target="#top_carousel" data-slide-to="<?=$i?>" <?=$i===0?'class="active"':''?> ></li>
        <?php
        }
        ?>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
        for ($i = 0; $i < count($headAd); $i++) {
            ?>
            <div class="item <?=$i===0?'active':''?>" style="text-align: center;">
                <a href="<?=$headAd[$i]->path?>" style="width: 100%;" target="_blank"><img src="<?=$headAd[$i]->img?>"  width="1090" height="40px" /></a>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<?php
}
?>
<!--header_top_add  头部广告 end-->

<div class="header_center_title">
    <section class="wrap_content_box" id="topBar">
        <?php
        if (Yii::$app->user->isGuest) {
            ?>
            <div class="header_center_title_left">爱生活，每天多一点！<a href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/login"><b>请登录</b></a><i>|</i><span><a href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/signup"><b>快速注册</b></a></span></div>
            <div class="header_center_title_right">
                <span class="chart_ico">购物车<a href="#"><b>0</b></a>件</span><i>|</i>
                <span class="sele_list"><a href="#">我的订单</a></span><i>|</i>
                <a href="#">联系客服</a><i>|</i>
                <a href="#">手机爱信阳</a>
            </div>
        <?php
        }else{
            ?>
            <div class="header_center_title_left">欢迎您，<a href="#"><b><?= Yii::$app->user->identity->userName===null? Yii::$app->user->identity->userAccount : Yii::$app->user->identity->userName?></b></a>
                <a data-method="post" href="<?= Yii::$app->urlManager->baseUrl?>/index.php?r=site/logout">退出</a><i>|</i>
                 <a class="dropdown-toggle dropdown--open" data-plugin="tBarMsg" data-toggle="dropdown">
                    <span class="dropdown-toggle"><i class="icon-envelope icon-animated-vertical"></i>
                     消息 <span class="badge badge-success">12</span></span>
                </a>
            </div>
            <div class="header_center_title_right">
                <span class="chart_ico">购物车<a href="#"><b>129</b></a>件</span><i>|</i>
                <span class="sele_list"><a href="#">我的订单</a></span><i>|</i>
                <a href="#">联系客服</a><i>|</i>
                <a href="#">手机爱信阳</a>
            </div>
        <?php
        }
        ?>
        <div class="clearfloat"></div>
    </section>
</div>
<!-- header_center_title 头部页眉  end-->

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
                    <span class="s_list">
                        <span class="s_list">商品</span>
                    </span>
				<span class="s_content">
				   <input type="search" list="search_list" autocomplete="on"  placeholder="请输入商品名称" />
				</span>
                    <span class="s_btn">搜索</span>
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
    <!-- header_bottom_menu 头部导航  end-->
</header>
<!--header  end-->

<section id="content">


<?php
if ($scrollAd !=null && $scrollAd!='') {
?>
<div id="carousel-generic" class="carousel slide banner" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php
        for ($i = 0; $i < count($scrollAd); $i++) {
            ?>
            <li data-target="#carousel-generic" data-slide-to="<?=$i?>" <?=$i===0?'class="active"':''?> ></li>
        <?php
        }
        ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <?php
        for ($i = 0; $i < count($scrollAd); $i++) {
            ?>
            <div class="item <?=$i===0?'active':''?>">
                <a href="<?=$scrollAd[$i]->path?>" style="width: 100%;" target="_blank"><img src="<?=$scrollAd[$i]->img?>"  /></a>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<?php
}
?>
<!--banner-->

<section class="wrap_content_box">

<?php   if  ($foodGoods !=null && $foodGoods!='') { ?>
<article class="food" id="food">
    <figure>
        <figcaption id="food_title"><a href="#">+&nbsp;更多</a></figcaption>
        <section class="food_content">
            <ul class="food_list">
                <?php
                for ($i = 1; $i <= count( $foodGoods); $i++) {
                    ?>
                    <li class="<?= $i%3 == 1 ? 'left_first':($i%3==0?'right_first':'center_first') ?>">
                        <a  target="_blank" href="<?=$foodGoods[$i-1]->path ?>"><img class="lazy" src="images/grey.gif" data-original="<?=$foodGoods[$i-1]->shopImg?>"   />
                        <figure class="food_list_texttop">
                            <figcaption class="food_name"><?=$foodGoods[$i-1]->name?></figcaption>
                            <p class="food_descrip"><?=$foodGoods[$i-1]->des?></p>
                        </figure>
                        <div class="food_list_textbottom"><span class="food_newprice">￥<?=$foodGoods[$i-1]->discountPrice?></span><span class="food_salesNum">销量：<?=$foodGoods[$i-1]->salesNum?></span><span class="food_oldprice">原价：￥<?=$foodGoods[$i-1]->price?></span><div class="clearfloat"></div></div>
                        </a>
                    </li>
                <?php
                }
                ?>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </figure>
</article>
<?php } ?>
<!--美食  end-->

<?php   if  ($hotelGoods !=null && $hotelGoods!='') { ?>
<article class="hotel" id="hotel">
    <figure>
        <figcaption id="hotel_title"><a href="#">+&nbsp;更多</a></figcaption>
        <section class="hotel_content">
            <ul class="hotel_list">
                <?php
                for ($i = 1; $i <= count( $hotelGoods); $i++) {
                    ?>
                    <li class="<?=  $i%2==0?'right':'left'  ?>">
                        <a  target="_blank" href="<?=$hotelGoods[$i-1]->path ?>"><img class="lazy" src="images/grey.gif" data-original="<?=$hotelGoods[$i-1]->shopImg?>"   />
                            <figure class="hotel_list_textleft">
                                <figcaption class="hotel_name"><?=$hotelGoods[$i-1]->name?></figcaption>
                                <p class="hotel_descrip"><?=$hotelGoods[$i-1]->des?></p>
                            </figure>
                            <div class="hotel_list_textright"><span class="hotel_newprice">￥<?=$hotelGoods[$i-1]->discountPrice?></span><span class="hotel_oldprice">原价：￥<?=$hotelGoods[$i-1]->price?></span><span class="hotel_salesNum">销量：<?=$hotelGoods[$i-1]->salesNum?></span><div class="clearfloat"></div></div>
                        </a>
                    </li>
                <?php
                }
                ?>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </figure>
</article>
<?php } ?>
<!--酒店/宾馆  end-->

<?php   if  ($movieGoods !=null && $movieGoods!='') { ?>
<article class="movie" id="movie">
    <figure>
        <figcaption id="movie_title"><a href="#">+&nbsp;更多</a></figcaption>
        <section class="movie_content">
            <ul class="movie_list">
                <?php
                for ($i = 1; $i <= count( $movieGoods); $i++) {
                    ?>
                    <li class="wrapbox">
                        <a href="<?=$movieGoods[$i-1]->path ?>"><img class="lazy" src="images/grey.gif" data-original="<?=$movieGoods[$i-1]->shopImg?>" />
                        <figure class="movie_list_textright">
                            <figcaption class="movie_name"><?=$movieGoods[$i-1]->name?></figcaption>
                            <p class="movie_descrip"><?=$movieGoods[$i-1]->des?></p>
                            <p><span class="movie_newprice">￥<?=$movieGoods[$i-1]->discountPrice?></span><span class="movie_salesNum">销量：<?=$movieGoods[$i-1]->salesNum?></span><span class="movie_oldprice">原价：￥<?=$movieGoods[$i-1]->price?></span><div class="clearfloat"></div></p>
                        </figure></a>
                        <div class="clearfloat"></div>
                    </li>
                <?php
                }
                ?>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </figure>
</article>
<?php } ?>
<!--电影  end-->

<?php   if  ($entertainmentGoods !=null && $entertainmentGoods!='') { ?>
<article class="entertainment" id="entertainment">
    <figure>
        <figcaption id="entertainment_title"><a href="#">+&nbsp;更多</a></figcaption>
        <section class="entertainment_content">
            <ul class="entertainment_list">
                <?php
                for ($i = 1; $i <= count( $entertainmentGoods); $i++) {
                    ?>
                    <li class="<?=  $i%2==0?'right':'left'  ?>">
                        <a  target="_blank" href="<?=$entertainmentGoods[$i-1]->path ?>"><img class="lazy" src="images/grey.gif" data-original="<?=$entertainmentGoods[$i-1]->shopImg?>"   />
                            <figure class="entertainment_list_textleft">
                                <figcaption class="entertainment_name"><?=$entertainmentGoods[$i-1]->name?></figcaption>
                                <p class="entertainment_descrip"><?=$entertainmentGoods[$i-1]->des?></p>
                            </figure>
                            <div class="entertainment_list_textright"><span class="entertainment_newprice">￥<?=$entertainmentGoods[$i-1]->discountPrice?></span><span class="entertainment_oldprice">原价：￥<?=$entertainmentGoods[$i-1]->price?></span><span class="entertainment_salesNum">销量：<?=$entertainmentGoods[$i-1]->salesNum?></span></div>
                            <div class="clearfloat"></div></div>
                        </a>
                    </li>
                <?php
                }
                ?>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </figure>
</article>
<?php } ?>
<!--休闲娱乐  end-->

<?php
  if  ($lifeserviceGoods !=null && $lifeserviceGoods!='') {
?>
<article class="lifeservice" id="lifeservice">
    <figure>
        <figcaption id="lifeservice_title"><a href="#">+&nbsp;更多</a></figcaption>
        <section class="entertainment_content">
            <ul class="entertainment_list">
                <?php
                for ($i = 1; $i <= count( $lifeserviceGoods); $i++) {
                    ?>
                    <li class="<?=  $i%2==0?'right':'left'  ?>">
                        <a  target="_blank" href="<?=$lifeserviceGoods[$i-1]->path ?>"><img class="lazy" src="images/grey.gif" data-original="<?=$lifeserviceGoods[$i-1]->shopImg?>"   />
                            <figure class="entertainment_list_textleft">
                                <figcaption class="entertainment_name"><?=$lifeserviceGoods[$i-1]->name?></figcaption>
                                <p class="entertainment_descrip"><?=$lifeserviceGoods[$i-1]->des?></p>
                            </figure>
                            <div class="entertainment_list_textright"><span class="entertainment_newprice">￥<?=$lifeserviceGoods[$i-1]->discountPrice?></span><span class="entertainment_oldprice">原价：￥<?=$lifeserviceGoods[$i-1]->price?></span><span class="entertainment_salesNum">销量：<?=$lifeserviceGoods[$i-1]->salesNum?></span></div>
                            <div class="clearfloat"></div></div>
                        </a>
                    </li>
                <?php
                }
                ?>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </figure>
</article>
<?php
}
?>
<!--生活服务  end-->

<?php
if  ($womenGoods !=null && $womenGoods!='') {
?>
<article class="food" id="women">
    <figure>
        <figcaption id="women_title"><a href="#">+&nbsp;更多</a></figcaption>
        <section class="food_content">
            <ul class="food_list">
                <?php
                for ($i = 1; $i <= count( $womenGoods); $i++) {
                    ?>
                    <li class="<?= $i%3 == 1 ? 'left_first':($i%3==0?'right_first':'center_first') ?>">
                        <a  target="_blank" href="<?=$womenGoods[$i-1]->path ?>"><img class="lazy" src="images/grey.gif" data-original="<?=$womenGoods[$i-1]->shopImg?>"   />
                            <figure class="food_list_texttop">
                                <figcaption class="food_name"><?=$womenGoods[$i-1]->name?></figcaption>
                                <p class="food_descrip"><?=$womenGoods[$i-1]->des?></p>
                            </figure>
                            <div class="food_list_textbottom"><span class="food_newprice">￥<?=$womenGoods[$i-1]->discountPrice?></span><span class="food_salesNum">销量：<?=$womenGoods[$i-1]->salesNum?></span><span class="food_oldprice">原价：￥<?=$womenGoods[$i-1]->price?></span><div class="clearfloat"></div></div>
                        </a>
                    </li>
                <?php
                }
                ?>
                <div class="clearfloat"></div>
            </ul>
        </section>
    </figure>
</article>
<?php
}
?>
<!--丽人  end-->

</section><!--内容-->

</section>
<!--section  主体内容  end-->



<aside class="leftbar" style="display:none;" id="home_nav_bar">
    <!--
    <a class="leftbar_list leftbar_list01" href="#"></a>
    <div class="leftbar_line"></div>
    <a class="leftbar_list leftbar_list06" href="#"></a>
     <div class="leftbar_line"></div>-->
    <?php   if  ($foodGoods !=null && $foodGoods!='') { ?><a class="leftbar_list leftbar_list03" id="leftbar_list03" href="#food"></a>
    <div class="leftbar_line"></div><?php } ?>
    <?php   if  ($hotelGoods !=null && $hotelGoods!='') { ?><a class="leftbar_list leftbar_list02" id="leftbar_list02" href="#hotel"></a>
    <div class="leftbar_line"></div><?php } ?>
    <?php   if  ($movieGoods !=null && $movieGoods!='') { ?><a class="leftbar_list leftbar_list04" id="leftbar_list04" href="#movie"></a>
    <div class="leftbar_line"></div><?php } ?>
    <?php   if  ($entertainmentGoods !=null && $entertainmentGoods!='') { ?><a class="leftbar_list leftbar_list05" id="leftbar_list05" href="#entertainment"></a>
    <div class="leftbar_line"></div><?php } ?>
    <?php   if  ($lifeserviceGoods !=null && $lifeserviceGoods!='') { ?><a class="leftbar_list leftbar_list07" id="leftbar_list07" href="#lifeservice"></a>
     <div class="leftbar_line"></div><?php } ?>
    <?php   if  ($womenGoods !=null && $womenGoods!='') { ?><a class="leftbar_list leftbar_list08" id="leftbar_list08" href="#women"></a><?php } ?>
 </aside>
 <!--leftbar 左侧悬浮导航  end-->

