<?php
$this->title = '我的购物车';
$topbar = false;
?>
<?php $this->registerCssFile("css/ShoppingCart_order.css"); ?>

<?php include '/../layouts/topbar.php';?>
<!--header  end-->
<section>
    <div class="wrap_content_box subpage">
        <div class="position_menu">当前位置：<a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">我的订单</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">我的购物车</a></div>
        <!--顶部位置导航  end-->
        <article class="top_chart">
            <div class="chart_left">
                <div class="chart_left_show"><span class="bar_down"></span></div>
            </div>

            <div class="clearfloat"></div>
        </article>
        <!--top 购物车menu  end-->
        <article class="chart_wrap">
            <table>
                <tr><th class="ch_a"><label><input class="se_a" type="checkbox" checked="checked" />全选</label></th><th class="ch_b">订单内容</th><th class="ch_a">单价</th><th class="ch_d">类型/数量</th><th class="ch_a">小计</th><th class="ch_d">状态/库存</th><th class="ch_e">操作</th></tr>

                <tr><td><input class="se_a" type="checkbox" checked /></td><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【浉河区】锅大侠火锅</a></h4><h5>锅大侠火锅2-3人套餐，可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥59</td><td><span class="less_more">-</span><input class="se_b" type="text" value="1" /><span class="less_more">+</span><div class="clearfloat"></div></td><td><em>￥59</em></td><td>可购买</td><td><a class="del" href="#"></a></td></tr>

                <tr class="unable"><td><input class="se_a" type="checkbox" /></td><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【包邮】膜语牛奶蜂蜜手蜡</a></h4><h5>“膜语牛奶蜂蜜手蜡，2瓶一疗程，不满意全额退款</h5></figure><div class="clearfloat"></div></td><td>￥459</td><td><span class="less_more">-</span><input class="se_b" type="text" value="1" /><span class="less_more">+</span><div class="clearfloat"></div></td><td><em>￥459</em></td><td>无货，不可购买</td><td><a class="del" href="#"></a></td></tr>

                <tr><td><input class="se_a" type="checkbox" checked /></td><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【新天地】中影国际影城</a></h4><h5>2D电影票1张，可观看2D，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥20</td><td><span class="less_more">-</span><input class="se_b" type="text" value="3" /><span class="less_more">+</span><div class="clearfloat"></div></td><td><em>￥60</em></td><td>可购买</td><td><a class="del" href="#"></a></td></tr>

                <tr><td><input class="se_a" type="checkbox" checked /></td><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【东方红大道】欢乐迪KTV</a></h4><h5>下午档欢唱实惠套餐，免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥36</td><td><span class="less_more">-</span><input class="se_b" type="text" value="3" /><span class="less_more">+</span><div class="clearfloat"></div></td><td><em>￥108</em></td><td>可购买</td><td><a class="del" href="#"></a></td></tr>

                <tr><td><input class="se_a" type="checkbox" checked /></td><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【包邮】天籁之城毛呢中长款休闲风衣</a></h4><h5>毛呢中长款休闲风，全国包邮</h5></figure><div class="clearfloat"></div></td><td>￥398</td><td><span class="less_more">-</span><input class="se_b" type="text" value="1" /><span class="less_more">+</span><div class="clearfloat"></div></td><td><em>￥398</em></td><td>可购买</td><td><a class="del" href="#"></a></td></tr>

                <tr><td><input class="se_a" type="checkbox" checked /></td><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【信阳师院】师院北京烤鸭</a></h4><h5>烤鸭1套，建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥20.9</td><td><span class="less_more">-</span><input class="se_b" type="text" value="3" /><span class="less_more">+</span><div class="clearfloat"></div></td><td><em>￥61.8</em></td><td>可购买</td><td><a class="del" href="#"></a></td></tr>
            </table>
        </article>
        <!--chart_wrap 购物车内容  end-->
        <article class="chart_bottom">
            <p>已选择<em>5</em>件商品<span>应付总额：<strong>￥686.8</strong></span></p>
            <p><label><input class="se_a" type="checkbox" checked  />使用积分</label><span><input class="se_c" type="text"  value="10000" /><em>-￥100</em><i>（当前积分：17879）</i></span></p>
            <p><span>实付总额：<strong>￥586.8</strong></span></p>
            <p><input class="se_d" type="submit" form="chart_order" value="" /></p>
        </article>
        <!--chart_bottom 订单提交  end-->
    </div>
</section>
<!--section  end-->
