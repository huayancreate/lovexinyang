<?php
$this->title = '选择支付方式';
$topbar = false;
?>
<?php $this->registerCssFile("css/ShoppingCart_order.css"); ?>

<?php include '/../layouts/topbar.php';?>

<!--header  end-->
  <section>  
	<div class="wrap_content_box subpage">
	  <!--顶部位置导航  end-->
        <article class="top_chart sub_sec">
            <a class="logo" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index"><img width="119" height="81" src="images/logo.jpg"></a>
            <div class="chart_menu sub_second">
                <ul>
                    <li class="sub_secondlist">1.确认订单信息</li>
                    <li class="bar bar2 bar3"></li>
                    <li class="sub_secondlist s_chected">2.选择支付方式</li>
                    <li class="bar bar1"></li>
                    <li class="sub_secondlist">3.支付成功</li>
                    <div class="clearfloat"></div>
                </ul>
            </div>
        </article>
	  <!--top 购物车menu  end-->
       <article class="order_confirmate">

           <div class="orders-summary">
               <div class="order-list">
                   <ul>
                       <li class="order-item">
                           <div class="order-name">金釜川韩式自助碳火烤肉：单人自助午餐，酒水饮料免费无限畅饮，自助，快乐享受</div>
                           <div class="order-number">1份</div>
                       </li>
                       <li class="order-item">
                           <div class="order-name">方燕烤猪蹄：美味方燕烤猪蹄，美容天使，吃猪蹄，更美丽</div>
                           <div class="order-number">2份</div>
                       </li>
                   </ul>
               </div>
               <div class="total-money">应付金额：<span class="money">55.00</span></div>
           </div>

         <section class="paymentstyle">
		   <form  id="" name="" method="post" action="">
		     <p>支付平台支付</p>
		     <div class="paylist">
		      <ul>
		       <li>
			    <label><input type="radio" name="paylist"  id="paylist_0" checked="checked"/><div class="paymentimage p_selected"><img src="images/Payment_01.jpg" title="支付宝支付" alt="支付宝支付"><h4>支付宝支付</h4></div></label>
			   </li>
			   <div class="clearfloat"></div>
		     </ul>
		    </div>
		    <input class="payment_next" type="submit" value="" />
		   </form>
		 </section>
	   </article>
	   <!--选择支付方式  end-->
    </div>
  </section>
 <!--section  end-->

