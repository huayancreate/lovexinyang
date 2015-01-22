<?php
$this->title = '订单确认';
$topbar = false;
?>
<?php $this->registerCssFile("css/ShoppingCart_order.css"); ?>

<?php include '/../layouts/topbar.php';?>
<!--header  end-->
<script>
    seajs.use('order/order', function (main) {
        main.init();
    });
</script>

<section>
    <div class="wrap_content_box subpage">
        <!--顶部位置导航  end-->
        <article class="top_chart sub_sec">
            <a class="logo" href="<?php Yii::$app->urlManager->baseUrl?>index.php?r=site/index"><img width="119" height="81" src="images/logo.jpg"></a>
            <div class="chart_menu sub_second">
                <ul>
                    <li class="sub_secondlist s_chected">1.确认订单信息</li>
                    <li class="bar bar1"></li>
                    <li class="sub_secondlist">2.选择支付方式</li>
                    <li class="bar bar2"></li>
                    <li class="sub_secondlist">3.支付成功</li>
                    <div class="clearfloat"></div>
                </ul>
            </div>
        </article>
        <!--top 购物车menu  end-->
        <article class="order_confirmate" style="display: none;">
            <div class="order_confirmate_title">确认收货地址<span><a href="#">管理收货地址</a></span><div class="clearfloat"></div></div>
            <div class="order_confirmate_wrap">
                <div class="p_divline"><h3>寄送至：</h3><h4>安徽省合肥市蜀山区黄山路624号桑夏精英时代广场22222室 </h4><span>默认地址<a href="#">修改本地址</a></span><div class="clearfloat"></div></div>
                <div class="p_divline"><h3>收货人：</h3><h4>司马懿</h4><div class="clearfloat"></div></div>
                <div class="p_divline"><h3>手机号码：</h3><h4>138 0551 7638</h4><span>换号了？<a href="#">绑定新手机号</a></span><div class="clearfloat"></div></div>
                <div class="p_divline"><h3></h3><h4><a class="o_button" href="#">+使用新地址</a></h4><div class="clearfloat"></div></div>
                <section class="order_newaddress">
                    <div class="p_divline">
                        <span class="addresslist"><select><option selected>安徽</option><option>河南</option><option>江苏</option><option>浙江</option><option>四川</option><option>云南</option></select>省/市/自治区<strong>*</strong></span>
                        <span class="addresslist"><select><option selected>合肥</option><option>池州</option><option>芜湖</option><option>安庆</option><option>黄山</option><option>宣城</option></select>市/旗<strong>*</strong></span>
                        <span class="addresslist"><select><option selected>蜀山</option><option>包河</option><option>庐阳</option><option>瑶海</option><option>巢湖</option><option>庐江</option></select>县/市/区/盟<strong>*</strong></span>
                        <span class="addresslist"><select><option selected>天乐社区</option><option>常青街道</option></select>社区/街道</span>
                    </div>
                    <textarea placeholder="可以在此输入您的详细地址，如黄山路6622号桑夏精英时代广场二楼666666室（徽商银行隔壁）" required></textarea>
                    <div class="p_divline"> <a class="save" href="#">取消</a><a class="save" href="#">保存</a><div class="clearfloat"></div></div>
                </section> <!--order_newaddress 添加、修改地址 默认隐藏-->
            </div>
        </article>
        <!--收货地址信息确认  end-->
        <article class="chart_wrap">
            <div class="order_confirmate_title">确认订单信息</div><br />
            <table>
                <tr><th class="ch_b">订单内容</th><th class="ch_a">单价</th><th class="ch_f">类型/数量</th><th class="ch_a">配送方式</th><th class="ch_a">小计</th></tr>

                <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【浉河区】锅大侠火锅</a></h4><h5>锅大侠火锅2-3人套餐，可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥59</td><td><span class="less_more">-</span><input class="se_b" type="text" value="1" /><span class="less_more">+</span><div class="clearfloat"></div></td><td>----</td><td><em>￥59</em></td></tr>

                <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【新天地】中影国际影城</a></h4><h5>2D电影票1张，可观看2D，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥20</td><td><span class="less_more">-</span><input class="se_b" type="text" value="3" /><span class="less_more">+</span><div class="clearfloat"></div></td><td>----</td><td><em>￥60</em></td></tr>

                <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【东方红大道】欢乐迪KTV</a></h4><h5>下午档欢唱实惠套餐，免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥36</td><td><span class="less_more">-</span><input class="se_b" type="text" value="3" /><span class="less_more">+</span><div class="clearfloat"></div></td><td>----</td><td><em>￥108</em></td></tr>

                <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【包邮】天籁之城毛呢中长款休闲风衣</a></h4><h5>毛呢中长款休闲风，全国包邮</h5></figure><div class="clearfloat"></div></td> <td>￥398</td> <td><span class="less_more">-</span><input class="se_b" type="text" value="1" /><span class="less_more">+</span><div class="clearfloat"></div></td> <td><select><option selected>快递免邮</option><option>自提</option></select></td> <td><em>￥398</em></td></tr>

                <tr><td><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【信阳师院】师院北京烤鸭</a></h4><h5>烤鸭1套，建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></td><td>￥20.9</td><td><span class="less_more">-</span><input class="se_b" type="text" value="3" /><span class="less_more">+</span><div class="clearfloat"></div></td><td>----</td><td><em>￥61.8</em></td></tr>
            </table>
        </article>
        <!--chart_wrap 购物车内容  end-->
        <article class="chart_bottom">
            <figure class="chart_bottom_box">
                <p><span>应付总额：<strong>￥686.8</strong></span></p>
                <p><label><input class="se_a" type="checkbox" checked  />使用积分</label><span><input class="se_c" type="text"  value="10000" /><em>-￥100</em><i>（当前积分：17879）</i></span></p>
                <p><span>实付总额：<strong>￥586.8</strong></span></p>
            </figure>
            <div class="clearfloat"></div>
            <p><input class="se_e" type="submit" form="order_payment" value="" /></p>
        </article>
        <!--chart_bottom 确认订单  end-->
    </div>
</section>
<!--section  end-->
