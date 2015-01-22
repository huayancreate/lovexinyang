<?php
$this->title = '商家搜索';
?>
<?php $this->registerCssFile("css/SearchPage.css"); ?>
<?php $this->registerCssFile("css/ShoppingCart_order.css"); ?>

<?php include '/../layouts/topbar.php';?>


  <section>  
	<div class="wrap_content_box subpage">
	  <div class="position_menu nothing">当前位置：<a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;“采蝶轩“</div>	
	  <!--顶部位置导航  end-->
	  <section class="search_conditions">
	    <article class="search_box">
		  <div class="search_title">筛选商家<a href="#">重置筛选条件</a><div class="clearfloat"></div></div>
		  <div class="search_content">
		    <div class="search_divline">共找到<strong>“采蝶轩”</strong>相关商家<strong>141</strong>个<a href="#">对搜索结果不满意？</a><div class="clearfloat"></div></div>
			<div class="search_show">
			   <div class="search_leftname">已选条件：</div>
			   <div class="search_rightlist_show"><span>分类：美食&nbsp;135<a href="#">×</a></span><span>区域：蜀山区&nbsp;28<a href="#">×</a></span><span>活动：限时打折&nbsp;109<a href="#">×</a></span></div>
			   <div class="clearfloat"></div>
			</div>
			<ul>
			   <li>
			   <div class="search_leftname">分类：</div>
			   <div class="search_rightlist">
			      <a class="sect" href="#">美食&nbsp;135</a><a href="#">生活服务&nbsp;4</a><a href="#">酒店宾馆&nbsp;2</a>
			   </div>
			   <div class="clearfloat"></div>
			  </li>
			  <li>
			   <div class="search_leftname">区域：</div>
			   <div class="search_rightlist">
			      <a class="sect" href="#">蜀山区&nbsp;28</a><a href="#">包河区&nbsp;14</a><a href="#">庐阳区&nbsp;32</a><a href="#">瑶海区&nbsp;22</a><a href="#">巢湖市&nbsp;35</a><a href="#">高新区&nbsp;11</a>
			   </div>
			   <div class="clearfloat"></div>
			  </li>
			  <li>
			   <div class="search_leftname">活动：</div>
			   <div class="search_rightlist">
			      <a href="#">打折&nbsp;123</a><a href="#">送积分&nbsp;121</a><a class="sect" href="#">限时打折&nbsp;109</a><a href="#">其他&nbsp;12</a>
			   </div>
			   <div class="clearfloat"></div>
			  </li>
			</ul>
		  </div>
		</article>
	  </section>
     <!--search_conditions 搜索条件  end-->
     <section class="sequence">
	   <div class="sequence_left"><i>排序：</i>
	     <a class="moren" href="#" title="按发布日期排序">默认排序</a><a href="#">总体评价</a><a href="#">评价数</a><a href="#">销量</a><label><input type="checkbox" />有在售团购</label>
		 <div class="clearfloat"></div>
	   </div>
	   <div class="sequence_right">共<span>141</span>个商家<b>|</b><span>1</span>/12页<a class="first" href="#" disabled>上一页</a><a href="#">下一页</a></div>
	   <div class="clearfloat"></div>
	 </section>
     <!--sequence 排序方式  end-->

	 <section class="search_onshow">			   
	   <div class="search_onshow_content business">
		 <ul class="business_list">
		   <li>
		     <figure class="business_title">
			  <div class="business_nameshow"><h4><a href="#">采蝶轩（三孝口长江路店）</a></h4><a class="a_alink" href="#">查看其他分店</a><p>地址：庐阳区长江中路邵氏电脑城西边（金川大厦东）</p><p>电话：400-887-5657</p><p>标签：<a class="a_alink" href="#">美食</a><a class="a_alink" href="#">蛋糕</a><a class="a_alink" href="#">三孝口</a></p></div>
			  <div class="business_evaluateshow"><p><span class="pingfen_show" title="总体评价4.0分"><span class="pingfen_show_on" style="width:80%"></span></span><strong title="总体评价4.0分">4.0分</strong><a class="a_alink" href="#"><em>9367</em>人评价</a></p><p>月销量：<em>15478925</em></p></div>
			  <div class="business_cardshow"><div class="carderpic"><img src="images/card.jpg" /></div><a class="common_botton" href="#">获取会员卡</a></div>
			  <div class="clearfloat"></div>
			 </figure>
	         <div class="chart_wrap order_boxing bussiness">
	          <table class="bussiness">
			   <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥159</td><td>现价：<strong>￥69</strong></td><td><em>5折</em><time>剩余：3天21小时</time></td><td>已售出：15468</td></tr>
		       <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕8选1，约25厘米，圆形</a></h4><h5>建议5-7人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥120</td><td>现价：<strong>￥39</strong></td><td><em>赠送999积分</em></td><td>已售出：58468</td></tr>
		   	  <tr class="last"><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>下建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥136</td><td>现价：<strong>￥59</strong></td><td><em>9折</em></td><td>已售出：38468</td></tr>
		     </table>
			 <div class="business_more"><a href="#">剩余12件商品</a></div>
	        </div>
		   </li>
		   <li>
		     <figure class="business_title">
			  <div class="business_nameshow"><h4><a href="#">采蝶轩（三孝口长江路店）</a></h4><a class="a_alink" href="#">查看其他分店</a><p>地址：庐阳区长江中路邵氏电脑城西边（金川大厦东）</p><p>电话：400-887-5657</p><p>标签：<a class="a_alink" href="#">美食</a><a class="a_alink" href="#">蛋糕</a><a class="a_alink" href="#">三孝口</a></p></div>
			  <div class="business_evaluateshow"><p><span class="pingfen_show" title="总体评价4.0分"><span class="pingfen_show_on" style="width:80%"></span></span><strong title="总体评价4.0分">4.0分</strong><a class="a_alink" href="#"><em>9367</em>人评价</a></p><p>月销量：<em>15478925</em></p></div>
			  <div class="business_cardshow"><div class="carderpic"><img src="images/card.jpg" /></div><a class="common_botton" href="#">获取会员卡</a></div>
			  <div class="clearfloat"></div>
			 </figure>
	         <div class="chart_wrap order_boxing bussiness">
	          <table class="bussiness">
			   <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥159</td><td>现价：<strong>￥69</strong></td><td><em>5折</em><time>剩余：3天21小时</time></td><td>已售出：15468</td></tr>
		       <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕8选1，约25厘米，圆形</a></h4><h5>建议5-7人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥120</td><td>现价：<strong>￥39</strong></td><td><em>赠送999积分</em></td><td>已售出：58468</td></tr>
		   	  <tr class="last"><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>下建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥136</td><td>现价：<strong>￥59</strong></td><td><em>9折</em></td><td>已售出：38468</td></tr>
		     </table>
			 <div class="business_more"><a href="#">剩余12件商品</a></div>
	        </div>
		   </li>
		   <li>
		     <figure class="business_title">
			  <div class="business_nameshow"><h4><a href="#">采蝶轩（三孝口长江路店）</a></h4><a class="a_alink" href="#">查看其他分店</a><p>地址：庐阳区长江中路邵氏电脑城西边（金川大厦东）</p><p>电话：400-887-5657</p><p>标签：<a class="a_alink" href="#">美食</a><a class="a_alink" href="#">蛋糕</a><a class="a_alink" href="#">三孝口</a></p></div>
			  <div class="business_evaluateshow"><p><span class="pingfen_show" title="总体评价4.0分"><span class="pingfen_show_on" style="width:80%"></span></span><strong title="总体评价4.0分">4.0分</strong><a class="a_alink" href="#"><em>9367</em>人评价</a></p><p>月销量：<em>15478925</em></p></div>
			  <div class="business_cardshow"><div class="carderpic"><img src="images/card.jpg" /></div><a class="common_botton" href="#">获取会员卡</a></div>
			  <div class="clearfloat"></div>
			 </figure>
	         <div class="chart_wrap order_boxing bussiness">
	          <table class="bussiness">
			   <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥159</td><td>现价：<strong>￥69</strong></td><td><em>5折</em><time>剩余：3天21小时</time></td><td>已售出：15468</td></tr>
		       <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕8选1，约25厘米，圆形</a></h4><h5>建议5-7人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥120</td><td>现价：<strong>￥39</strong></td><td><em>赠送999积分</em></td><td>已售出：58468</td></tr>
		   	  <tr class="last"><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>下建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥136</td><td>现价：<strong>￥59</strong></td><td><em>9折</em></td><td>已售出：38468</td></tr>
		     </table>
			 <div class="business_more"><a href="#">剩余12件商品</a></div>
	        </div>
		   </li>
		   <li class="last">
		     <figure class="business_title">
			  <div class="business_nameshow"><h4><a href="#">采蝶轩（三孝口长江路店）</a></h4><a class="a_alink" href="#">查看其他分店</a><p>地址：庐阳区长江中路邵氏电脑城西边（金川大厦东）</p><p>电话：400-887-5657</p><p>标签：<a class="a_alink" href="#">美食</a><a class="a_alink" href="#">蛋糕</a><a class="a_alink" href="#">三孝口</a></p></div>
			  <div class="business_evaluateshow"><p><span class="pingfen_show" title="总体评价4.0分"><span class="pingfen_show_on" style="width:80%"></span></span><strong title="总体评价4.0分">4.0分</strong><a class="a_alink" href="#"><em>9367</em>人评价</a></p><p>月销量：<em>15478925</em></p></div>
			  <div class="business_cardshow"><div class="carderpic"><img src="images/card.jpg" /></div><a class="common_botton" href="#">获取会员卡</a></div>
			  <div class="clearfloat"></div>
			 </figure>
	         <div class="chart_wrap order_boxing bussiness">
	          <table class="bussiness">
			   <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥159</td><td>现价：<strong>￥69</strong></td><td><em>5折</em><time>剩余：3天21小时</time></td><td>已售出：15468</td></tr>
		       <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕8选1，约25厘米，圆形</a></h4><h5>建议5-7人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥120</td><td>现价：<strong>￥39</strong></td><td><em>赠送999积分</em></td><td>已售出：58468</td></tr>
		   	  <tr class="last"><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">蛋糕2选1，约20厘米，圆形</a></h4><h5>下建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td class="old_price">原价：￥136</td><td>现价：<strong>￥59</strong></td><td><em>9折</em></td><td>已售出：38468</td></tr>
		     </table>
			 <div class="business_more"><a href="#">剩余12件商品</a></div>
	        </div>
		   </li>
		 </ul>
	   </div>
	 </section>
	 <!--商家搜索结果展现  end-->

	  <div class="rangpage" style="padding-left:305px; margin:10px auto"><a class="first">首页</a><a class="first">上一页</a><a href="#">1</a><a href="#">2</a><a href="#">3</a>...&nbsp;&nbsp;<a href="#">22</a><a href="#">下一页</a><a href="#">尾页</a></div>					
     </div>
  </section>
  <!--section  主体内容  end-->
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
  <aside class="right_listbar">
    <div class="right_listbar_up">
	  <ul>
	   <li><a  class="list10" href="#" title="个人中心"></a></li>
	   <li style=" height:120px; margin-bottom:10px; overflow:hidden"><a  class="list06" href="#" title="我的购物车">1299</a></li>
	   <li><a  class="list01" href="#" title="我的财产"></a></li>
	   <li><a  class="list02" href="#" title="我的收藏"></a></li>
	   <li><a  class="list03" href="#" title="我看过的"></a></li>
	   <li><a  class="list04" href="#" title="我要充值"></a></li>
	  </ul>
	</div>
	<div class="right_listbar_down">
	  <ul>
	   <li><a  class="list05" href="#" title="在线客服"></a></li>
	   <li><a  class="list07" href="#" title="意见反馈"></a></li>
	   <li><a  class="list08" href="#" title="帮助中心"></a></li>
	   <li><a  class="list09" href="#" title="返回顶部"></a></li>
	  </ul>
	</div>
  </aside>
 <!--right_listbar 右侧悬浮菜单  end-->
 </body>
</html>
