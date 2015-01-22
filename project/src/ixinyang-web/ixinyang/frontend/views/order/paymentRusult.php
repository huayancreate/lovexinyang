<?php
$this->title = '付款成功';
$topbar = false;
?>
<?php $this->registerCssFile("css/ShoppingCart_order.css"); ?>

<?php include '/../layouts/topbar.php';?>

  <section>  
	<div class="wrap_content_box subpage">
	  <!--顶部位置导航  end-->
        <article class="top_chart sub_sec">
            <a class="logo" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index"><img width="119" height="81" src="images/logo.jpg"></a>
            <div class="chart_menu sub_second">
                <ul>
                    <li class="sub_secondlist">1.确认订单信息</li>
                    <li class="bar bar2 "></li>
                    <li class="sub_secondlist ">2.选择支付方式</li>
                    <li class="bar bar1 bar3"></li>
                    <li class="sub_secondlist s_chected">3.支付成功</li>
                    <div class="clearfloat"></div>
                </ul>
            </div>
        </article>
	  <!--top 购物车menu  end-->
       <article class="successfulpayment">
         <div class="successful_ico">成功付款至爱信阳，确认收货后商家将收到您的款项。</div>
		 <section class="successfu_msgshow">
		  <div class="successfu_msgshow_title">付款详情</div>
		  <div class="successfu_msgshow_wrap">
		   <p>订单编号：<span>68542841846756854</span></p>
		   <p>付款方式：<span>储蓄卡支付</span></p>
		   <p>付款账号：<span>2322*******5687（支付宝）</span></p>
		   <p>收款账号：<span>xxx1*******1122（爱生活平台）</span></p>
		   <p>收款户名：<span>爱生活</span></p>
		   <p>付款金额：<strong>￥586.8</strong></p>
		   <p>付款时间：<time>2014.10.25 15:36:45</time></p>
		   <p>交易状态：<span>付款成功</span></p>
		  </div>
		 </section>
		 <div class="successfu_msgshow_bottom"><a href="OrderDetails.html">查看订单详情</a><a href="#">继续购物</a><a href="#">收藏商品</a><a href="#">打印交易凭证</a><a class="end" href="#">返回我的订单</a></div>
	   </article>
	   <!--付款成功  end-->
    </div>
  </section>
 <!--section  end-->
