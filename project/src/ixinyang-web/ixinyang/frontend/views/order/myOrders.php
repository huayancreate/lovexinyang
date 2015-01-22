<?php
$this->title = '我的订单';
$topbar = false;
?>
<?php $this->registerCssFile("css/ShoppingCart_order.css"); ?>

<?php include '/../layouts/topbar.php';?>

<section>
    <div class="wrap_content_box subpage">
        <div class="position_menu">当前位置：<a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;<a href="#">我的订单</a></div>
        <!--顶部位置导航  end-->
        <article class="order_confirmate order_detail">
            <div class="order_confirmate_title">我的订单</div>
            <div class="order_confirmate_wrap myorder">
                <section class="myorder_top">
                    <div class="myorder_top_left">
                        <label><input type="checkbox" checked />全选</label><a href="#">全部删除</a><a href="#">全部付款</a><a class="unsel" href="#">所有订单</a>
                        <div class="clearfloat"></div>
                    </div>
                    <div class="myorder_top_right"><span>1</span>/3页<a class="first" href="#">上一页</a><a href="#">下一页</a></div>
                    <div class="clearfloat"></div>
                </section>
                <!--可操作  end-->
                <section class="p_divline">
                    <div class="myorder_middle_title ch_b">订单内容</div>
                    <div class="myorder_middle_title ch_a">单价</div>
                    <div class="myorder_middle_title ch_a">类型/数量</div>
                    <div class="myorder_middle_title ch_c">状态</div>
                    <div class="myorder_middle_title ch_a">折扣</div>
                    <div class="myorder_middle_title ch_f">小计</div>
                    <div class="myorder_middle_title last ch_d">操作</div>
                    <div class="clearfloat"></div>
                </section>
                <section class="myorder_wrap">
                    <ul>
                        <li>
                            <div class="myorder_wrap_caption"><label><input type="checkbox" checked />订单编号：<span>201436578425</span></label>商家：<span>锅大侠火锅（信阳二店）</span>电话：<span>0376--6508099</span><a href="#">商家信息</a></div>
                            <div class="myorder_box">
                                <div class="myorder_wrap_content ch_b"><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【浉河区】锅大侠火锅</a></h4><h5>锅大侠火锅2-3人套餐，可升级，提供免费WiFi</h5></figure><div class="clearfloat"></div></div>
                                <div class="myorder_wrap_content ch_f">￥59</div>
                                <div class="myorder_wrap_content ch_a">1</div>
                                <div class="myorder_wrap_content ch_c2"><span class="zhuangtai">交易成功</span><span class="zhuangtai">未评价</span></div>
                                <div class="myorder_wrap_content ch_a">无折扣</div>
                                <div class="myorder_wrap_content ch_e"><i>￥59</i></div>
                                <div class="myorder_wrap_content last ch_d"><a class="myorder_operate details" href="#">订单详情</a><a class="myorder_operate pay_ing" href="#">再次购买</a><a class="myorder_operate pingjia" href="#">现在评价</a><a class="myorder_operate delete" href="#">删除订单</a></div>
                                <div class="clearfloat"></div>
                            </div>
                        </li>
                        <li>
                            <div class="myorder_wrap_caption"><label><input type="checkbox" checked />订单编号：<span>201436578425</span></label>商家：<span>锅大侠火锅（信阳二店）</span>电话：<span>0376--6508099</span><a href="#">商家信息</a></div>
                            <div class="myorder_box">
                                <div class="myorder_wrap_content ch_b"><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【新天地】中影国际影城</a></h4><h5>2D电影票1张，可观看2D，提供免费WiFi</h5></figure><div class="clearfloat"></div></div>
                                <div class="myorder_wrap_content ch_f">￥20</div>
                                <div class="myorder_wrap_content ch_a">3</div>
                                <div class="myorder_wrap_content ch_c2"><span class="zhuangtai">已付款</span><span class="zhuangtai">未发货</span></div>
                                <div class="myorder_wrap_content ch_a">8折</div>
                                <div class="myorder_wrap_content ch_e"><i>￥60</i></div>
                                <div class="myorder_wrap_content last ch_d"><a class="myorder_operate details" href="#">订单详情</a><a class="myorder_operate cancel" href="#">取消订单</a><a class="myorder_operate remind" href="#">提醒发货</a><a class="myorder_operate delete" href="#">删除订单</a></div>
                                <div class="clearfloat"></div>
                            </div>
                        </li>
                        <li>
                            <div class="myorder_wrap_caption"><label><input type="checkbox" checked />订单编号：<span>201436578425</span></label>商家：<span>锅大侠火锅（信阳二店）</span>电话：<span>0376--6508099</span><a href="#">商家信息</a></div>
                            <div class="myorder_box">
                                <div class="myorder_wrap_content ch_b"><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【东方红大道】欢乐迪KTV</a></h4><h5>下午档欢唱实惠套餐，免费WiFi</h5></figure><div class="clearfloat"></div></div>
                                <div class="myorder_wrap_content ch_f">￥36</div>
                                <div class="myorder_wrap_content ch_a">3</div>
                                <div class="myorder_wrap_content ch_c"><span class="zhuangtai">未付款</span></div>
                                <div class="myorder_wrap_content ch_a">8折</div>
                                <div class="myorder_wrap_content ch_e"><i>￥108</i></div>
                                <div class="myorder_wrap_content last ch_d"><a class="myorder_operate details" href="#">订单详情</a><a class="myorder_operate pay" href="#">现在付款</a><a class="myorder_operate delete" href="#">删除订单</a></div>
                                <div class="clearfloat"></div>
                            </div>
                        </li>
                        <li>
                            <div class="myorder_wrap_caption"><label><input type="checkbox" checked />订单编号：<span>201436578425</span></label>商家：<span>锅大侠火锅（信阳二店）</span>电话：<span>0376--6508099</span><a href="#">商家信息</a><a class="define" href="#">确认收货</a><div class="clearfloat"></div></div>
                            <div class="myorder_box">
                                <div class="myorder_wrap_content ch_b"><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【包邮】天籁之城毛呢中长款休闲风衣</a></h4><h5>毛呢中长款休闲风，全国包邮</h5></figure><div class="clearfloat"></div></div>
                                <div class="myorder_wrap_content ch_f">￥3988</div>
                                <div class="myorder_wrap_content ch_a">1</div>
                                <div class="myorder_wrap_content ch_c2"><span class="zhuangtai">已付款</span><span class="zhuangtai">已发货</span></div>
                                <div class="myorder_wrap_content ch_a">8折</div>
                                <div class="myorder_wrap_content ch_e"><i>￥3988</i></div>
                                <div class="myorder_wrap_content last ch_d"><a class="myorder_operate details" href="#">订单详情</a><a class="myorder_operate cancel" href="#">取消订单</a><a class="myorder_operate logistics" href="#">查看物流</a><a class="myorder_operate delete" href="#">删除订单</a></div>
                                <div class="clearfloat"></div>
                            </div>
                        </li>
                        <li>
                            <div class="myorder_wrap_caption"><label><input type="checkbox" checked />订单编号：<span>201436578425</span></label>商家：<span>锅大侠火锅（信阳二店）</span>电话：<span>0376--6508099</span><a href="#">商家信息</a></div>
                            <div class="myorder_box">
                                <div class="myorder_wrap_content ch_b"><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【包邮】天籁之城毛呢中长款休闲风衣</a></h4><h5>毛呢中长款休闲风，全国包邮</h5></figure><div class="clearfloat"></div></div>
                                <div class="myorder_wrap_content ch_f">￥398</div>
                                <div class="myorder_wrap_content ch_a">1</div>
                                <div class="myorder_wrap_content ch_c2"><span class="zhuangtai">交易成功</span><span class="zhuangtai">已评价</span></div>
                                <div class="myorder_wrap_content ch_a">8折</div>
                                <div class="myorder_wrap_content ch_e"><i>￥398</i></div>
                                <div class="myorder_wrap_content last ch_d"><a class="myorder_operate details" href="#">订单详情</a><a class="myorder_operate pay_ing" href="#">再次购买</a><a class="myorder_operate pingjia" href="#">追加评价</a><a class="myorder_operate delete" href="#">删除订单</a></div>
                                <div class="clearfloat"></div>
                            </div>
                        </li>
                        <li>
                            <div class="myorder_wrap_caption"><label><input type="checkbox" checked />订单编号：<span>201436578425</span></label>商家：<span>锅大侠火锅（信阳二店）</span>电话：<span>0376--6508099</span><a href="#">商家信息</a></div>
                            <div class="myorder_box">
                                <div class="myorder_wrap_content ch_b"><div class="chart_wrap_img"><a href="#"><img src="images/small01.jpg" /></a></div><figure class="chart_wrap_text"><h4><a href="#">【信阳师院】师院北京烤鸭</a></h4><h5>烤鸭1套，建议2-3人使用，提供免费WiFi</h5></figure><div class="clearfloat"></div></div>
                                <div class="myorder_wrap_content ch_f">￥20.9</div>
                                <div class="myorder_wrap_content ch_a">3</div>
                                <div class="myorder_wrap_content ch_c"><span class="zhuangtai">交易关闭</span></div>
                                <div class="myorder_wrap_content ch_a">8折</div>
                                <div class="myorder_wrap_content ch_e"><i>￥61.8</i></div>
                                <div class="myorder_wrap_content last ch_d"><a class="myorder_operate details" href="#">订单详情</a><a class="myorder_operate buy" href="#">立刻购买</a><a class="myorder_operate delete" href="#">删除订单</a></div>
                                <div class="clearfloat"></div>
                            </div>
                        </li>
                    </ul>
                    <div class="rangpage" style="padding-left:305px; margin:10px auto"><a class="first">首页</a><a class="first">上一页</a><a href="#">1</a><a href="#">2</a><a href="#">3</a>...&nbsp;&nbsp;<a href="#">22</a><a href="#">下一页</a><a href="#">尾页</a></div>
                </section>
            </div>
        </article>
    </div>
</section>
<!--section  end-->
